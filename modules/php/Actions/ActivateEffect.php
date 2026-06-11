<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;
use ALT\Core\Notifications;

class ActivateEffect extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_ACTIVATE_EFFECT;
  }

  public function getDescription()
  {
    if (is_null($this->getCtxArgs()['cardId'] ?? null)) {
      if ($this->getArg('effectType') == 'Played') {
        return clienttranslate('activate {J} effect');
      } elseif ($this->getArg('effectType') == 'Reserve') {
        return clienttranslate('activate {R} effect');
      } elseif ($this->getArg('effectType') == 'Support') {
        return clienttranslate('activate {D} effect');
      }
    } else {
      $card = $this->getCard();
      if ($card instanceof \ALT\Helpers\Collection) {
        if ($this->getArg('effectType') == 'Played') {
          return clienttranslate('activate {J} effect');
        } elseif ($this->getArg('effectType') == 'Reserve') {
          return clienttranslate('activate {R} effect');
        } elseif ($this->getArg('effectType') == 'Support') {
          return clienttranslate('activate {D} effect');
        }
      }
      if ($this->getArg('effectType') == 'Played') {
        return [
          'log' => clienttranslate('activate {J} effect of ${card_name}'),
          'args' => ['card_name' => $this->getCard()->getName(), 'i18n' => ['card_name']],
        ];
      } elseif ($this->getArg('effectType') == 'Reserve') {
        return [
          'log' => clienttranslate('activate {R} effect of ${card_name}'),
          'args' => ['card_name' => $this->getCard()->getName(), 'i18n' => ['card_name']],
        ];
      } elseif ($this->getArg('effectType') == 'Support') {
        return [
          'log' => clienttranslate('activate {D} effect of ${card_name}'),
          'args' => ['card_name' => $this->getCard()->getName(), 'i18n' => ['card_name']],
        ];
      }
    }
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    return true;
  }

  public function getCard()
  {
    $cardId = $this->getCtxArg('cardId');

    // ownEffect + Support (e.g. output 840): activate my {D}, not the card that triggered
    // the listener. ownEffect + Reserve (Thomas Edison, output 705) activates another
    // card's {R} and falls through to target-bound cardId / getSource() below.
    if ($this->getArg('ownEffect') && $this->getArg('effectType') === 'Support') {
      if (!is_null($cardId) && $cardId != ME && $cardId != EFFECT) {
        return Cards::get($cardId);
      }
      $ownerId = $this->ctx->getSourceId();
      if (!is_null($ownerId)) {
        return Cards::get($ownerId);
      }
    }

    if ($cardId == ME || is_null($cardId)) {
      $source = $this->getSource();
      $cardId = is_null($source) ? null : $source->getId();
    } elseif ($cardId == EFFECT) {
      $event = $this->getEventRecursive();
      $cardId = $event['cardId'] ?? null;
    }

    if (is_null($cardId)) {
      throw new \BgaVisibleSystemException('no card in args (Activate effect). Should not happen');
    }
    return Cards::get($cardId);
  }

  protected $args = [
    'effectType' => 'Played',
    'n' => INFTY,
    'ownEffect' => false
  ];

  public function stActivateEffect()
  {
    $cards = $this->getCard();
    $nodes = [];

    if (!$cards instanceof \ALT\Helpers\Collection) {
      $cards = [$cards->getId() => $cards];
    }

    foreach ($cards as $cardId => $card) {
      if (
        ($card->getType() == CHARACTER && !Players::hasOpponentBlockingPower($card->getPlayer(), $card->getLocation(), $card->isGigantic())) ||
        $card->getType() != CHARACTER || !in_array(CHARACTER, $card->getAdditionalType())
      ) {
        $effect = 'getEffect' . $this->getArg('effectType');
        switch ($this->getArg('effectType')) {
          case 'Played':
            $msg = clienttranslate('${player_name} activates ${card_name} {J} effect');
            break;
          case 'Reserve':
            $msg = clienttranslate('${player_name} activates ${card_name} {R} effect');
            break;
          case 'Support':
            $msg = clienttranslate('${player_name} activates ${card_name} {D} effect');
            break;
          default:
            throw new \BgaVisibleSystemException('Unknown effectType in ActivateEffect: ' . $this->getArg('effectType'));
        }

        if (!empty($card->$effect())) {
          Notifications::message($msg, [
            'player' => Players::getActive(),
            'card' => $card,
          ]);
          $node = $card->$effect();
          // ownEffect: nested effects run as the source card (Thomas Edison), not the target.
          $tagSourceId = $this->getArg('ownEffect')
            ? ($this->ctx->getSourceId() ?? $card->getId())
            : $card->getId();
          $node = Utils::tagTree($node, ['sourceId' => $tagSourceId]);
          $node = Utils::tagTree($node, ['pId' => $card->getPId()]);
          // $node['sourceId'] = $card->getId();
          if (!isset($node['action']) && ($node['type'] ?? NODE_PARALLEL) == NODE_PARALLEL) {
            foreach ($node['childs'] as $n) {
              $nodes[] = $n;
            }
          } else {
            $nodes[] = $node;
          }

          // Some cards (e.g. Yeong-Gi & Ember) activate a {D} ability without going through
          // ChooseAssignment::actSupport. Mirror the same "discard ability activated" accounting
          // and listener event so cards tracking {D} activations can react.
          if ($this->getArg('effectType') == 'Support') {
            $activePlayer = Players::getActive();
            $abilityActivated = Globals::getAbilityActivatedThisTurn();
            $abilityActivated[$activePlayer->getId()] = array_merge(
              $abilityActivated[$activePlayer->getId()] ?? [],
              ['discard' => true]
            );
            Globals::setAbilityActivatedThisTurn($abilityActivated);

            $abilityActivatedCount = Globals::getAbilityActivatedThisTurnCount();
            $abilityActivatedCount[$activePlayer->getId()] = ($abilityActivatedCount[$activePlayer->getId()] ?? 0) + 1;
            Globals::setAbilityActivatedThisTurnCount($abilityActivatedCount);

            $abilityActivatedTypeCount = Globals::getAbilityActivatedThisTurnTypeCount();
            $abilityActivatedTypeCount[$activePlayer->getId()] = $abilityActivatedTypeCount[$activePlayer->getId()] ?? [];
            $abilityActivatedTypeCount[$activePlayer->getId()]['discard'] = ($abilityActivatedTypeCount[$activePlayer->getId()]['discard'] ?? 0) + 1;
            Globals::setAbilityActivatedThisTurnTypeCount($abilityActivatedTypeCount);

            $this->checkAfterListeners($activePlayer, [
              'cardId' => $cardId,
              'playCard' => false,
              'isSupport' => true,
              'sourceId' => $cardId,
              'pId' => $activePlayer->getId(),
            ], true, 'ChooseAssignment');
          }
        }
      } else {
        Notifications::message(clienttranslate('Effects are not triggered, due to an effect in the opponent\'s expedition'), []);
      }
    }

    if (count($nodes) > 0) {
      if (count($nodes) > 1 && $this->getArg('n') > 1) {
        $nodes = ['type' => NODE_OR, 'optional' => true, 'args' => ['n' => $this->getArg('n')], 'childs' => $nodes];
      } elseif ($this->getArg('n') == 1 && count($nodes) > 1) {
        // only 1 potential choice
        $nodes = FT::XOR(...$nodes);
      } else {
        // only 1 node
        $nodes = $node;
      }
      $this->pushParallelChild($nodes);
    }

    $this->resolveAction([]);
  }
}

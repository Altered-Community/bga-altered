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
      }
    } else {
      $card = $this->getCard();
      if ($card instanceof \ALT\Helpers\Collection) {
        if ($this->getArg('effectType') == 'Played') {
          return clienttranslate('activate {J} effect');
        } elseif ($this->getArg('effectType') == 'Reserve') {
          return clienttranslate('activate {R} effect');
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
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
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
    $source = $this->getSource();
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
        }
        Notifications::message($msg, [
          'player' => Players::getActive(),
          'card' => $card,
        ]);
        if (!empty($card->$effect())) {
          $node = $card->$effect();
          if ($this->getArg('ownEffect')) {
            $node = Utils::tagTree($node, ['sourceId' => $source->getId()]);
          } else {
            $node = Utils::tagTree($node, ['sourceId' => $card->getId()]);
          }
          $node = Utils::tagTree($node, ['pId' => $card->getPId()]);
          // $node['sourceId'] = $card->getId();
          if (!isset($node['action']) && ($node['type'] ?? NODE_PARALLEL) == NODE_PARALLEL) {
            foreach ($node['childs'] as $n) {
              $nodes[] = $n;
            }
          } else {
            $nodes[] = $node;
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

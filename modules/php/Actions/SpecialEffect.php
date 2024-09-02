<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Stats;
use ALT\Helpers\FT;
use ALT\Core\Notifications;
use ALT\Core\Game;
use ALT\Core\Engine;
use ALT\Helpers\Utils;

class SpecialEffect extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_SPECIAL_EFFECT;
  }

  public function getDescription()
  {
    $effect = $this->getArg('effect');

    if ($effect == 'gainCounter') {
      return [
        'log' => clienttranslate('Gain ${n} ${counter_name}'),
        'args' => [
          'n' => $this->getArg('args')['counter'],
          'counter_name' => $this->getArg('args')['counterName'],
          'i18n' => ['counter_name'],
        ],
      ];
    } elseif ($effect == 'nextCharacterGains1Boost') {
      return clienttranslate('Next character <BOOST>');
    } elseif ($effect == 'nextCharacterGains2Boost') {
      return clienttranslate('Next character 2<BOOST>');
    } elseif ($effect == 'AuraqKibble') {
      return clienttranslate('Draw and keep card or play it for free');
      // } elseif ($effect == 'boost3Stat0') {
      //   return clienttranslate('Gain 1<BOOST> if there are 3 base statistic at 0');
    }
    return '';
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
      throw new \BgaVisibleSystemException('no card in args (special effect). Should not happen');
    }
    return Cards::get($cardId);
  }

  protected $args = ['effect' => null, 'args' => []];

  public function stSpecialEffect()
  {
    $effect = $this->getArg('effect');
    $args = $this->getArg('args') ?? [];
    $card = $this->getSource();

    switch ($effect) {
      case 'useCard':
        $data = $card->getExtraDatas();
        $data['userPower'] = true;
        $card->setExtraDatas($data);
        break;

      case 'costReduction':
        $reduction = Globals::getCostReduction();
        $reduction[$card->getPId()][$args['type']]['reduction'] =
          ($reduction[$card->getPId()][$args['type']]['reduction'] ?? 0) + $args['reduction'];
        $reduction[$card->getPId()][$args['type']]['permanent'] =
          ($reduction[$card->getPId()][$args['type']]['permanent'] ?? false) || ($args['permanent'] ?? false);
        Globals::setCostReduction($reduction);
        break;
      case 'gainCounter':
        $data = $card->getExtraDatas();
        $data['counter'] = ($data['counter'] ?? 0) + ($args['counter'] ?? 0);
        $data['counterName'] = $args['counterName'] ?? '';
        $card->setExtraDatas($data);

        Notifications::gainCounter($this->getSource(), $args['counter']);
        break;
      case 'incCounter':
        $data = $card->getExtraDatas();
        $data['counter'] = ($data['counter'] ?? 0) + ($args['counter'] ?? 0);
        $data['counterName'] = $args['counterName'] ?? '';
        $card->setExtraDatas($data);

        Notifications::gainCounter($this->getSource(), $args['counter']);
        break;
      case 'activateAllPermanents':
        $cards = $card->getPlayer()->getPermanents();
        $childs = [];
        foreach ($cards as $cId => $card) {
          $childs[] = [
            'action' => ACTIVATE_EFFECT,
            'optional' => true,
            'args' => ['cardId' => $cId],
            'sourceId' => $card->getId(),
          ];
        }
        $this->pushParallelChilds($childs);
        break;
      case 'activateAllOtherCharacters':
        $cards = $card->getPlayer()->getPlayedCards();
        $childs = [];
        foreach ($cards as $cId => $card) {
          if ($card->getType() != CHARACTER || $cId == $this->getSourceId()) {
            continue;
          }

          if (empty($card->getEffectPlayed())) {
            continue;
          }

          $childs[] = [
            'action' => ACTIVATE_EFFECT,
            'optional' => true,
            'args' => ['cardId' => $cId],
            'sourceId' => $card->getId(),
          ];
        }
        $this->pushParallelChilds($childs);
        break;
      case 'nextCharacterGains1Boost':
        Globals::incNextCharacterBoost(1);
        break;
      case 'nextCharacterGains2Boost':
        Globals::incNextCharacterBoost(2);
        break;
      case 'nextSpellIsFree':
        Globals::setNextSpellIsFree(true);
        Notifications::message(clienttranslate('Next spell played this turn will be free (${card_name}\'s effect)'), [
          'card' => $card,
        ]);
        break;
      case 'nextCharacterCost3Anchored':
        Globals::setNextCharacterCost3Anchored(true);
        break;
      case 'removeFleetingIfPlayedHand':
        Globals::setRemoveFleetingIfPlayedHand(true);
        break;
      case 'removeFleetingSpellPlayed':
        Globals::setRemoveFleetingSpellPlayed(true);
        break;
      case 'removeFleetingCharacterPlayed':
        Globals::setRemoveFleetingCharacterPlayed(true);
        break;
      case 'removeFleetingIfSpellPlayedHand':
        Globals::setRemoveFleetingIfSpellPlayedHand(true);
        break;
      case 'boostAllSubtype':
        if (!isset($args['subType'])) {
          throw new \BgaVisibleSystemException('No subtype defined for boostAllSubtype. Shoud not happen');
        }
        $subType = $args['subType'];
        $excludeSelf = $args['excludeSelf'] ?? false;
        $n = $args['n'] ?? 1;
        $player = $card->getPlayer();
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $pCard) {
          if ($excludeSelf && $cId == $card->getId()) {
            continue;
          }
          if (in_array($subType, $pCard->getSubtypes())) {
            $nodes[] = FT::GAIN($pCard, BOOST, $n);
          }
        }
        $this->pushParallelChilds($nodes);
        break;
      case 'boostXReserve':
        $n = $card
          ->getPlayer()
          ->getReserveCards()
          ->count();
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boostXLandmark':
        $n = $card
          ->getPlayer()
          ->getLandmarks()
          ->count();
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boostXReserveAll':
        $n = 0;
        foreach (Players::getAll() as $pId => $player) {
          $n += $player->getReserveCards()->count();
        }

        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boost3Stat0':
        $nb = 0;
        foreach ($card->getPlayer()->getPlayedCards() as $cId => $c) {
          if (!in_array($c->getType(), [CHARACTER, TOKEN])) {
            continue;
          }

          foreach ($c->getBiomes(false) as $type => $value) {
            if ($value == 0) {
              $nb++;
            }
          }
        }
        if ($nb >= 3) {
          $this->insertAsChild(FT::GAIN($card, BOOST));
        }
        break;
      case 'boost23Stat0':
        $nb = 0;
        foreach ($card->getPlayer()->getPlayedCards() as $cId => $c) {
          if (!in_array($c->getType(), [CHARACTER, TOKEN])) {
            continue;
          }

          foreach ($c->getBiomes(false) as $type => $value) {
            if ($value == 0) {
              $nb++;
            }
          }
        }
        if ($nb >= 3) {
          $this->insertAsChild(FT::GAIN($card, BOOST, 2));
        }
        break;
      case 'discardAllHand':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          $nodes[] = FT::ACTION(DISCARD, ['pId' => $pId, 'special' => 'allHand']);
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);

        break;
      case 'discardAllHandReserve':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          $nodes[] = FT::ACTION(DISCARD, ['pId' => $pId, 'special' => 'allHandReserve']);
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);

        break;
      case 'instantWin':
        if (Globals::getInstantWin() == false) {
          $card->getPlayer()->setScore(1);
          Globals::setInstantWin(true);
          Notifications::message(clienttranslate('${player_name} wins the game with ${card_name}\'s effect'), [
            'player' => $card->getPlayer(),
            'card' => $card,
          ]);
        }
        break;
      case 'MindApotheosis':
        Engine::checkpoint();
        // draw 4 cards
        $player = $card->getPlayer();
        $drawn = $player->draw(4, null, null, $card);
        // Target only Characters drawn
        $this->insertAsChild(
          FT::ACTION(
            TARGET,
            [
              'n' => 2,
              'upTo' => true,
              'effect' => FT::SEQ(FT::ACTION(PLAY_CARD, ['free' => true, 'effectHand' => false]), FT::GAIN(EFFECT, FLEETING)),
              'targetLocation' => [HAND],
              'targetPlayer' => ME,
              'cards' => $drawn->getIds(),
              'discardRemaining' => true,
            ],
            ['sourceId' => $card->getId()]
          )
        );
        break;
      case 'AuraqKibble':
        Engine::checkpoint();
        // draw 1 card
        $player = $card->getPlayer();
        $drawn = $player->draw(1, null, null, $card)->first();
        // Target only Characters drawn
        $this->insertAsChild(
          FT::ACTION(
            PLAY_CARD,
            [
              'cardId' => $drawn->getId(),
              'free' => true,
              'effectHand' => false,
            ],
            ['sourceId' => $card->getId(), 'optional' => true]
          )
        );
        break;
      case 'triggerEffectOfNextCharacter':
        $addEffects = Globals::getAdditionalEffect();
        $addEffects = array_merge($addEffects, [['type' => $args['type'], 'from' => $args['from'], 'effect' => $args['effect']]]);
        Globals::setAdditionalEffect($addEffects);
        Notifications::message(clienttranslate('${player_name} will trigger {R} effect of next played character'), [
          'player' => Players::getActive(),
        ]);
        break;
      case 'AfterRestSabotage':
        $afterRest = Globals::getAfterRest();
        $pId = $card->getPlayer()->getId();
        if (!isset($afterRest[$pId])) {
          $afterRest[$pId] = [];
        }
        $afterRest[$pId] = array_merge($afterRest[$pId], [
          FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
              'targetLocation' => [RESERVE],
              'upTo' => true,
              'effect' => FT::ACTION(DISCARD, []),
            ],
            ['sourceId' => $card->getId()]
          ),
        ]);
        Globals::setAfterRest($afterRest);
        break;
      case 'AfterRestOrdisRecruit':
        $afterRest = Globals::getAfterRest();
        $pId = $card->getPlayer()->getId();
        if (!isset($afterRest[$pId])) {
          $afterRest[$pId] = [];
        }
        $afterRest[$pId] = array_merge($afterRest[$pId], [
          FT::ACTION(
            INVOKE_TOKEN,
            [
              'pId' => 'source',
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => STORMS,
            ],
            ['sourceId' => $card->getId()]
          ),
        ]);
        Globals::setAfterRest($afterRest);
        break;
      case 'AfterRest2OrdisRecruit':
        $afterRest = Globals::getAfterRest();
        $pId = $card->getPlayer()->getId();
        if (!isset($afterRest[$pId])) {
          $afterRest[$pId] = [];
        }
        $afterRest[$pId] = array_merge($afterRest[$pId], [
          FT::ACTION(
            INVOKE_TOKEN,
            [
              'pId' => 'source',
              'tokenType' => 'OD_Common_OrdisRecruit',
              'n' => 2,
              'targetLocation' => STORMS,
            ],
            ['sourceId' => $card->getId()]
          ),
        ]);
        Globals::setAfterRest($afterRest);
        break;
      case 'afterRest':
        $afterRest = Globals::getAfterRest();
        $pId = $card->getPlayer()->getId();
        if (!isset($afterRest[$pId])) {
          $afterRest[$pId] = [];
        }

        // We tag the tree to transport the source
        $args = Utils::tagTree($args, ['sourceId' => $card->getId()]);

        // if we have a card invoking with the parameter source we substitute it with current location
        $args = Utils::updateTree($args, [0 => 'source'], [$card->getLocation()], ['targetLocation']);


        $afterRest[$pId] = array_merge($afterRest[$pId], [$args]);
        // throw new \feException(print_r($afterRest));
        Globals::setAfterRest($afterRest);
        break;
      case 'AllPlayersSacrifice1':
        $activePlayer = Players::getActive();
        $player = $activePlayer;
        $nodes = null;
        do {
          $nodes[] = FT::ACTION(
            TARGET,
            [
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN],
              'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            ],
            ['pId' => $player->getId(), 'sourceId' => $card->getId()]
          );
          $player = Players::getNext($player);
        } while ($player->getId() != $activePlayer->getId());
        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        Notifications::message(clienttranslate('All players must sacrifice 1 character (${card_name}\'s effect)'), [
          'card' => $card,
        ]);
        break;
      case 'eachPlayerOptionalResupply':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          $nodes[] = [
            'type' => NODE_SEQ,
            'optional' => true,
            'pId' => $pId,
            'childs' => [FT::ACTION(RESUPPLY, [], ['pId' => $pId, 'sourceId' => $this->getSourceId()])],
          ];
        }
        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      case 'fleetingAllCharacters':
        $player = Players::getActive();
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $card) {
          if (!in_array($card->getType(), [CHARACTER, TOKEN]) || $card->hasToken(FLEETING)) {
            continue;
          }
          $nodes[] = FT::GAIN($cId, FLEETING);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }

        break;
      case 'sleepingAllCharactersinExpedition':
        $expedition = $this->getCtxArg('expedition');
        $pId = $this->getCtxArg('player');
        $nodes = [];

        foreach (Players::get($pId)->getPlayedCards() as $cId => $card) {
          if (!in_array($card->getType(), [CHARACTER, TOKEN]) || $card->hasToken(ASLEEP) || $card->getLocation() != $expedition) {
            continue;
          }
          $nodes[] = FT::GAIN($cId, ASLEEP);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      default:
        break;
    }

    $this->resolveAction([]);
  }
}

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
use ALT\Helpers\Conditions;

class SpecialEffect extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_SPECIAL_EFFECT;
  }

  public function getDescription()
  {
    $effect = $this->getArg('effect');
    $args = $this->getArg('args') ?? [];

    switch ($effect) {
      case 'gainCounter':
      case 'incCounter':
        return [
          'log' => clienttranslate('Gain ${n} ${counter_name}'),
          'args' => [
            'n' => $this->getArg('args')['counter'],
            'counter_name' => $this->getArg('args')['counterName'],
            'i18n' => ['counter_name'],
          ],
        ];
      case 'nextCharacterGains1Boost':
        return clienttranslate('Next character <BOOST>');
      case 'nextReserveCharacterGains1Boost':
        return clienttranslate('Next character played from Reserve <BOOST>');
      case 'nextCharacterGains2Boost':
        return clienttranslate('Next character 2<BOOST>');
      case 'AuraqKibble':
        return clienttranslate('Draw and keep card or play it for free');
      case 'useCard':
        return clienttranslate('Flag the card');
      case 'costReduction':
        return clienttranslate('Reduce cost of next card');
        break;
      case 'gainCounter':
        return clienttranslate('Gain a counter');
        break;
      case 'incCounter':
        return clienttranslate('Increment a counter');
        break;
      case 'activateAllPermanents':
        return clienttranslate('Activate all permanents');
        break;
      case 'activateAllOtherCharacters':
        return clienttranslate('Activate all other abilities');
        break;
      case 'nextCharacterGains1Boost':
        return clienttranslate('Next character gains <BOOST>');
        break;
      case 'nextCharacterGains2Boost':
        return clienttranslate('Next character gains 2 <BOOST>');
        break;
      case 'nextSpellIsFree':
        return clienttranslate('Next spell is free');
        break;
      case 'nextCharacterCost3Anchored':
      case 'nextCharacterAnchored':
      case 'nextTokenAnchored':
      case 'nextCharacterBaseCost3Anchored':
        return clienttranslate('Next character gains <ANCHORED>');
        break;
      case 'removeFleetingIfPlayedHand':
        return clienttranslate('Remove fleeting if played from hand');
        break;
      case 'removeFleetingSpellPlayed':
        return clienttranslate('Remove fleeting if next card is a spell');
        break;
      case 'removeFleetingCharacterPlayed':
        return clienttranslate('Remove fleeting if next card is a character');
        break;
      case 'removeFleetingIfSpellPlayedHand':
        return clienttranslate('Remove fleeting if next card is a spell played from hand');
        break;
      case 'boostAllSubtype':
        return clienttranslate('Boost all subtype');
        break;
      case 'boostAllCharacters':
        return clienttranslate('Boost all characters');
        break;
      case 'boostAllCharactersInExpedition':
        return clienttranslate('Boost all characters');
        break;
      case 'fleetingAllCharactersInExpedition':
        return clienttranslate('Fleeting all characters in target expedition');
        break;
      case 'boostAllCharactersExceptSelf':
        return clienttranslate('Boost all characters except me');
        break;
      case 'boostXReserve':
        return clienttranslate('Boost number of cards in reserve');
        break;
      case 'boostXLandmark':
        return clienttranslate('Boost number of landmarks');
        break;
      case 'boostXReserveAll':
        return clienttranslate('Boost number of all cards in reserve');
        break;
      case 'boost3Stat0':
        return clienttranslate('Boost if more than 3 0 statistics');
        break;
      case 'boost23Stat0':
        return clienttranslate('Boost if more than 3 0 statistics');
        break;
      case 'discardAllHand':
        return clienttranslate('Discard all hands');
        break;
      case 'discardAllHandReserve':
        return clienttranslate('Discard all hands and reserve');
        break;
      case 'instantWin':
        return clienttranslate('Immediate win');
        break;
      case 'MindApotheosis':
        return clienttranslate('Mind Apotheosis');
        break;
      case 'triggerEffectOfNextCharacter':
        return clienttranslate('Trigger ability of next character');
        break;
      case 'AfterRestSabotage':
        return clienttranslate('Sabotage after rest');
        break;
      case 'AfterRestOrdisRecruit':
        return clienttranslate('Invoke Ordis recruit after rest');
        break;
      case 'AfterRest2OrdisRecruit':
        return clienttranslate('Invoke 2 Ordis recruit after rest');
        break;
      case 'invokeOrdisRecruitBureaucrat':
        return clienttranslate('Invoke 1 Ordirs recruit for each Bureaucrat you control');
        break;
      case 'afterRest':
        return clienttranslate('Trigger the effect after rest');
      case 'AllPlayersSacrifice1':
        return clienttranslate('All players sacrifice 1 character');
        break;
      case 'eachPlayerOptionalResupply':
        return clienttranslate('All players may resupply');
      case 'eachPlayerResupply':
        return clienttranslate('All players resupply');
      case 'eachPlayerOptionalHandReserve':
        return clienttranslate('All players may put a card from their Hand in Reserve');
      case 'eachPlayerOptionalHandReserveDraw':
        return clienttranslate('All players may put a card from their Hand in Reserve to draw a card');
      case 'fleetingAllCharacters':
        return clienttranslate('All characters gain fleeting');
        break;
      case 'sleepingAllCharactersinExpedition':
        return clienttranslate('Put to sleep characters in the expedition');
        break;
      case 'boostXFleetingChar':
        return clienttranslate('1 Boost for each Fleeting character');
        break;
      case 'nextCharacterFleeting':
        return clienttranslate('Next character gains <FLEETING');
      case 'playAll1Card':
        return clienttranslate('All players play for free one card with hand cost {3} or less');
      case 'boostXForForest':
        return clienttranslate('1 Boost for each expedition in Forest');
      case 'eachPlayerAsleep':
        return clienttranslate('Each player target a Character, gain <ASLEEP>');
      case 'sendToReserveCharactersAndExhaustInExpedition':
        return clienttranslate('Send to reserve characters and exhaust them');
      case 'exhaustAllCards':
        return clienttranslate('Exhaust all cards in Reseve');
      case 'eachPlayerExhaust':
        return clienttranslate('Each player exhausts a card in reserve');
        // Bise
      case 'boostReserve':
        return clienttranslate('Characters in your Reserve gain 1 boost');
      case 'boostXBoostedChar':
        return clienttranslate('1 Boost for each Boosted character');
        break;
      case 'boostXAnchoredChar':
        return clienttranslate('1 Boost for each Anchored character');
        break;
      case 'boostXreserveBoost':
        return clienttranslate('For each boost, boost 1 character in reserve');
      case 'augmentXreserveBoost':
        return clienttranslate('For each boost, augment 1 card');
      case 'boostXMana':
        return clienttranslate('1 Boost for each Mana Orb');
      case 'boostedRevealBaseStat':
        if ($args['bypass'] ?? false) {
          return clienttranslate('Draw a card and keep Character with a base statistic of 0');
        }
        return clienttranslate('If boosted, draw a card and keep Character with a base statistic of 0');
      case 'boostedRevealArtistSong':
        if ($args['bypass'] ?? false) {
          return clienttranslate('Draw a card and keep Artist or Song');
        }
        return clienttranslate('If boosted, draw a card and keep Artist or Song');
      case 'boostedRevealRobotPermanent':
        if ($args['bypass'] ?? false) {
          return clienttranslate('Draw a card and keep Robot or Permanent');
        }
        return clienttranslate('If boosted, draw a card and keep Robot or Permanent');
      case 'ManInTheMaze':
      case 'ManInTheMazeRare':
      case 'ManInTheMazeYzmir':
        return clienttranslate('Remove all boost and resolve effect');
      case 'removeFleetingCharacterStat0Played':
        return clienttranslate('Remove fleeting if next card is a character with base statistic 0');
      case 'removeFleetingSongArtistPlayed':
        return clienttranslate('Remove fleeting if next card is an Artist or Song');
      case 'doubleBoosts':
        return clienttranslate('Double the boosts in reserve & expeditions');
      case 'counterPerCharacter':
        return clienttranslate('Gain 1 counter per Character you control');
      case 'boostAndRemoveFromExpedition':
        return clienttranslate('Gain 1 boost per character then remove characters');
      case 'RunesTestamentLook4':
        return clienttranslate('Look at the 4 first cards, keep 1 and discard the others');
      case 'invokeRecruitBehind':
        return clienttranslate('Invoke 1 Ordis recruit on each tied/behind expedition');
      case 'invokeBrassbugBehind':
        return clienttranslate('Invoke 1 Brassbug on each tied/behind expedition');
      case 'counterPerOpponentCharacter':
        return clienttranslate('1 boost per opponent controlled characters');
      case 'boostHandCards':
        return clienttranslate('Gain 1 boost per card in hand');
      case 'boostReserveCards':
        return clienttranslate('Gain 1 boost per card in reserve');
      case 'revealTopAndDraw':
        return clienttranslate('Reveal the top card. If cost = die, draw it');
      case 'exhaustPlayFree':
        return clienttranslate('Exhaust Wayfarer and play card for free');
      case 'manInTheMazeUnique':
        return clienttranslate('Trigger Man in the maze unique effects');
      case 'hunger':
        return clienttranslate('Discard all other cards in play or in Reserve');
      case 'reveal':
        return clienttranslate('Reveal a card');
      case 'ascend':
        return clienttranslate('Ascend');
      case 'switchPlayer':
        return clienttranslate('Change First player');
      case 'allCharacterFleeting':
        return clienttranslate('All characters gain <FLEETING>');
      case 'allPass':
        return clienttranslate('All players pass');
      case 'boostTargetReserveCards':
        return clienttranslate('Gain 1 boost per card in reserve');
      case 'boostXOpponentExpedition':
        return clienttranslate('Gain 1 boost per character in expeditions facing card');
      case 'nextTokenAsleep':
        return clienttranslate('Token gains <ASLEEP>');
      case 'boostReserveSubtype':
        return clienttranslate('Each reserve of specific subtype gain 1 <BOOST>');
      case 'defect':
        return clienttranslate('defect');
      case 'drawReveal':
        return clienttranslate('Draw the reveal card');
        // DUSTER
      case 'boostXExhaustedMax3':
        return clienttranslate('Boost 1 per exhausted (max 3)');
      case 'copyGift':
        return clienttranslate('Copy the Gift');
      case 'boostXLandmarkMax3':
        return clienttranslate('Boost max up to 3');
      case 'sacrificeHighestCharacter':
        return clienttranslate('Sacrifice highest opponent character');
      case 'sacrificeHighestCharacterPermanent':
        return clienttranslate('Sacrifice highest opponent character or permanent');
    }
    return '';
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIndependent($player = null)
  {
    $source = $this->getSource();
    if ($source != null) {
      if ($source->getRarity() == RARITY_UNIQUE) {
        return false;
      }
    }

    switch ($this->getArg('effect')) {
      case 'boostXFleetingChar':
      case 'boostXAnchoredChar':
      case 'boostXBoostedChar':
      case 'counterPerCharacter':
      case 'counterPerOpponentCharacter':
      case 'boostAllCharactersExceptSelf':
      case 'boostHandCards':
      case 'boostXreserveBoost':
      case 'boostXReserve':
      case 'drawTopIfRoll':
      case 'exhaustPlayFree':
      case 'hunger':
      case 'boostTargetReserveCards':
      case 'boostXOpponentExpedition':
      case 'boostXExhaustedMax3':
      case 'boostXLandmarkMax3':
      default:
        return false;
    }
    return true;

    // $effect = $this->getArg('effect');
    // // Manage blockAutomaticAction
    // if (in_array($effect, [])) {
    // }
    // return true;
  }

  public function getCard()
  {
    $args = $this->getCtxArgs();
    $cardId = $args['cardId'] ?? null;
    if ($cardId === null) {
      throw new \BgaVisibleSystemException('no card in args (special effect). Should not happen');
    }
    if ($cardId == ME) {
      $cardId = $this->getSource()->getId();
    }
    return Cards::get($cardId);
  }

  protected $args = ['effect' => null, 'args' => []];

  public function stSpecialEffect()
  {
    $effect = $this->getArg('effect');
    $args = $this->getArg('args') ?? [];
    $card = $this->getSource();
    if (!is_null($card)) {
      $sourceId = $card->getId();
    } else {
      $sourceId = null;
    }

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
        if (isset($args['minimum'])) {
          $reduction[$card->getPId()][$args['type']]['minimum'] = $args['minimum'];
        }
        Globals::setCostReduction($reduction);
        break;
      case 'gainCounter':
        $data = $card->getExtraDatas();
        if (($data['counter'] ?? 0) > 0 && in_array($card->getLocation(), [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE]) && $card->hasCounters() && Players::hasBlockGainNewCounters()) {
          Notifications::message(clienttranslate('No new counter can be added to cards'), []);
          $this->resolveAction([]);
          return;
        }

        // No counter can be gained in hand
        if ($card->getLocation() == HAND) {
          $this->resolveAction();
          return;
        }

        if ((($data['counter'] ?? 0) + ($args['counter'] ?? 0)) > ($args['maxCounter'] ?? 99)) {
          $args['counter'] = ($args['maxCounter'] ?? 99) - ($data['counter'] ?? 0);
        }

        if ($args['counter'] ?? 0 > 0) {
          $data['counter'] = ($data['counter'] ?? 0) + ($args['counter'] ?? 0);
          $data['counterName'] = $args['counterName'] ?? '';
          $card->setExtraDatas($data);

          Notifications::gainCounter($this->getSource(), $args['counter']);
          $this->checkAfterListeners($card->getPlayer(), ['sourceId' => $card->getId(), 'specialEffect' => 'gainCounter']);
        }
        break;
      case 'incCounter':
        $data = $card->getExtraDatas();
        if (($data['counter'] ?? 0) > 0 && in_array($card->getLocation(), [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE]) && $card->hasCounters() && Players::hasBlockGainNewCounters()) {
          Notifications::message(clienttranslate('No new counter can be added to cards'), []);
          $this->resolveAction([]);
          return;
        }
        // No counter can be gained in hand
        if ($card->getLocation() == HAND) {
          $this->resolveAction();
          return;
        }
        if ((($data['counter'] ?? 0) + ($args['counter'] ?? 0)) > ($args['maxCounter'] ?? 99)) {
          $args['counter'] = ($args['maxCounter'] ?? 99) - ($data['counter'] ?? 0);
        }

        if ($args['counter'] ?? 0 > 0) {
          $data['counter'] = ($data['counter'] ?? 0) + ($args['counter'] ?? 0);
          $data['counterName'] = $args['counterName'] ?? '';
          $card->setExtraDatas($data);

          Notifications::gainCounter($this->getSource(), $args['counter']);
          $this->checkAfterListeners($card->getPlayer(), ['sourceId' => $card->getId(), 'specialEffect' => 'gainCounter']);
        }
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
            'pId' => $card->getPId()
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
            'pId' => $card->getPId()
          ];
        }
        $this->pushParallelChilds($childs);
        break;
      case 'nextCharacterGains1Boost':
        Globals::incNextCharacterBoost(1);
        Globals::incNextCharacterBoostOccurence(1);
        break;
      case 'nextReserveCharacterGains1Boost':
        Globals::incNextReserveCharacterBoost(1);
        break;
      case 'nextCharacterGains2Boost':
        Globals::incNextCharacterBoost(2);
        Globals::incNextCharacterBoostOccurence(1);
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
      case 'nextCharacterAnchored':
        Globals::setNextCharacterAnchored(true);
        break;
      case 'nextTokenAnchored':
        Globals::setNextTokenAnchored(true);
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
      case 'nextCharacterFleeting':
        Globals::setNextCharacterFleeting(true);
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
      case 'boostAllCharacters':
        $player = $card->getPlayer();
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $pCard) {
          if (in_array($pCard->getType(), [TOKEN, CHARACTER])) {
            $nodes[] = FT::GAIN($pCard, BOOST, 1);
          }
        }
        $this->pushParallelChilds($nodes);
        break;
      case 'boostAllCharactersInExpedition':
        $player = Players::get($this->getArg('player'));
        $expedition = $this->getArg('expedition');
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $pCard) {
          if ($pCard->getLocation() == $expedition && in_array($pCard->getType(), [TOKEN, CHARACTER])) {
            $nodes[] = FT::GAIN($pCard, BOOST, 1);
          }
        }
        $this->pushParallelChilds($nodes);
        break;
      case 'fleetingAllCharactersInExpedition':
        $player = Players::get($this->getArg('player'));
        $expedition = $this->getArg('expedition');
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $pCard) {
          if ($pCard->getLocation() == $expedition && in_array($pCard->getType(), [TOKEN, CHARACTER])) {
            $nodes[] = FT::GAIN($pCard, FLEETING, 1);
          }
        }
        $this->pushParallelChilds($nodes);
        break;
      case 'boostAllCharactersExceptSelf':
        $player = $card->getPlayer();
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $pCard) {
          if ($cId != $card->getId() && in_array($pCard->getType(), [TOKEN, CHARACTER])) {
            $nodes[] = FT::GAIN($pCard, BOOST, 1);
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
      case 'boostXFleetingChar';
        $n = $card
          ->getPlayer()
          ->getPlayedCards([CHARACTER, TOKEN])
          ->filter(function ($c) {
            return $c->hasToken(FLEETING);
          })
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
          Stats::setWinner($card->getPlayer(), 1);
          Stats::setGameWinner($card->getPlayer()->getHero()->getStatData());
          Stats::setGameLooser(Players::getNext($card->getPlayer())->getHero()->getStatData());
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
              'effect' => FT::SEQ(FT::ACTION(PLAY_CARD, ['free' => true, 'reallyPlayed' => false, 'effectHand' => false]), FT::GAIN(EFFECT, FLEETING)),
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

        $player = $card->getPlayer();
        $pId = $player->getId();
        $drawn = $player->draw(1, null, 'reveal-' . $player->getId(), $this->getSource(), clienttranslate('${player_name} reveals ${card_names} from its deck (${card_name2}\'s effect)'), clienttranslate('${you} reveals ${card_names} from its deck (${card_name2}\'s effect)'))->first();

        $this->insertAsChild(FT::XOR(
          FT::ACTION(
            PLAY_CARD,
            [
              'cardId' => $drawn->getId(),
              'free' => true,
              'effectHand' => false,
            ],
            ['sourceId' => $card->getId(), 'optional' => true]
          ),
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'drawReveal'], ['sourceId' => $card->getId()])
        ));

        // draw 1 card
        // $player = $card->getPlayer();
        // $drawn = $player->draw(1, null, null, $card)->first();
        // // Target only Characters drawn
        // $this->insertAsChild(
        //   FT::ACTION(
        //     PLAY_CARD,
        //     [
        //       'cardId' => $drawn->getId(),
        //       'free' => true,
        //       'effectHand' => false,
        //     ],
        //     ['sourceId' => $card->getId(), 'optional' => true]
        //   )
        // );
        break;
      case 'triggerEffectOfNextCharacter':
        $addEffects = Globals::getAdditionalEffect();
        $found = false;
        foreach ($addEffects as $i => $effect) {
          if (isset($effect['sourceId'])) {
            unset($effect['sourceId']);
          }
          if (isset($effect['boost'])) {
            unset($effect['boost']);
          }
          if ($effect == [
            'type' => $args['type'],
            'from' => $args['from'],
            'limit' => $args['limit'] ?? INFTY,
            'effect' => $args['effect'],
            'to' => ($args['to'] ?? null)
          ]) {
            Notifications::message(clienttranslate('Effect is ignored as already triggered'));
            $found = true;
            break;
          }
        }
        if ($found === false) {
          $eff = [
            'type' => $args['type'],
            'from' => $args['from'],
            'effect' => $args['effect'],
            'to' => ($args['to'] ?? null),
            'sourceId' => $card->getId(),
            'limit' => $args['limit'] ?? INFTY,
          ];
          if (($args['boost'] ?? 0) > 0) {
            $eff['boost'] = $args['boost'];
          }
          $addEffects = array_merge($addEffects, [$eff]);
          Globals::setAdditionalEffect($addEffects);
          Notifications::message(clienttranslate('${player_name} will trigger {R} effect of next played character'), [
            'player' => Players::getActive(),
          ]);
        }
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
      case 'invokeOrdisRecruitBureaucrat':
        $pId = $card->getPlayer()->getId();
        $nodes = [];

        $bureaucrats = $card->getPlayer()->getPlayedCards()->filter(function ($c) {
          return in_array(BUREAUCRAT, $c->getSubtypes());
        })->count();
        if ($bureaucrats != 0) {
          for ($i = 0; $i < $bureaucrats; $i++) {
            $nodes[] =  FT::ACTION(
              INVOKE_TOKEN,
              [
                'pId' => 'source',
                'tokenType' => 'OD_Common_OrdisRecruit',
                'targetLocation' => ['source'],
              ],
              ['sourceId' => $card->getId()]
            );
          }
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }

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
        $args = Utils::updateTree($args, [0 => 'initialSource'], [$card->getLocation()], ['targetLocation']);



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
      case 'eachPlayerResupply':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          $nodes[] = [
            'type' => NODE_SEQ,
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
          if (!in_array($card->getType(), [CHARACTER, TOKEN]) || $card->hasToken(ASLEEP) || ($card->getLocation() != $expedition && !$card->isGigantic())) {
            continue;
          }
          $nodes[] = FT::GAIN($cId, ASLEEP);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'sendToReserveCharactersAndExhaustInExpedition':
        $expedition = $this->getCtxArg('expedition');
        $pId = $this->getCtxArg('player');
        $nodes = [];
        $exhaust = [];
        $ownerId = $card->getPId();

        foreach (Players::get($pId)->getPlayedCards() as $cId => $card) {
          if (!in_array($card->getType(), [CHARACTER, TOKEN]) || ($card->getLocation() != $expedition && !$card->isGigantic())) {
            continue;
          }
          $nodes[] = FT::ACTION(DISCARD, ['cardId' => $cId, 'destination' => RESERVE], ['sourceId' => $this->getSourceId(), 'pId' => $ownerId]);
          $exhaust[] = FT::ACTION(EXHAUST, ['cardId' => $cId], ['sourceId' => $this->getSourceId(), 'pId' => $ownerId]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild([
            'type' => NODE_SEQ,
            'childs' => [
              ['type' => NODE_SEQ, 'childs' => $nodes],
              ['type' => NODE_SEQ, 'childs' => $exhaust],
            ]
          ]);
        }
        break;
      case 'readyAllReserve':
        $player = Players::getActive();
        $nodes = [];
        foreach ($player->getReserveCards() as $cId => $card) {
          if (!$card->isTapped()) {
            continue;
          }
          $nodes[] = FT::ACTION(READY, ['cardId' => $cId], ['sourceId' => $this->getSourceId()]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'exhaustAllCards':
        $nodes = [];
        $cPId = $card->getPId();
        foreach (Players::getAll() as $pId => $player) {
          foreach ($player->getReserveCards() as $cId => $card) {
            if ($card->isTapped()) {
              continue;
            }
            $nodes[] = FT::ACTION(EXHAUST, ['cardId' => $cId], ['sourceId' => $this->getSourceId(), 'pId' => $cPId]);
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'playAll1Card':
        $nodes = [];
        $turnOrder = Players::getTurnOrder(Players::getActiveId());
        foreach ($turnOrder as $pId) {
          $nodes[] = FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'maxHandCost' => 3, 'free' => true], ['pId' => $pId, 'optional' => true, 'sourceId' => $this->getSourceId()]);
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);

        break;
      case 'eachPlayerOptionalHandReserve':
        $nodes = [];
        $turnOrder = Players::getTurnOrder(Players::getActiveId());
        foreach ($turnOrder as $pId) {
          $nodes[] = FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, SPELL, PERMANENT],
              'targetPlayer' => ME,
              'upTo' => true,
              'targetLocation' => [HAND],
              'effect' => FT::DISCARD_TO_RESERVE(),
            ],
            ['optional' => true, 'pId' => $pId, 'sourceId' => $this->getSourceId()]
          );
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      case 'eachPlayerOptionalHandReserveDraw':
        $nodes = [];
        $turnOrder = Players::getTurnOrder(Players::getActiveId());
        foreach ($turnOrder as $pId) {
          $nodes[] = FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, SPELL, PERMANENT],
              'targetPlayer' => ME,
              'upTo' => true,
              'targetLocation' => [HAND],
              'effect' => FT::SEQ(FT::DISCARD_TO_RESERVE(), FT::ACTION(DRAW, ['players' => ME]))
            ],
            ['optional' => true, 'pId' => $pId, 'sourceId' => $this->getSourceId()]
          );
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      case 'eachPlayerExhaust':
        $nodes = [];
        $turnOrder = Players::getTurnOrder(Players::getActiveId());
        foreach ($turnOrder as $pId) {
          $nodes[] = FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, SPELL, PERMANENT],
              'targetPlayer' => ME,
              'targetLocation' => [RESERVE],
              'effect' => FT::ACTION(EXHAUST, [])
            ],
            ['pId' => $pId, 'sourceId' => $this->getSourceId()]
          );
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      case 'boostXForForest':
        $biomes = Players::filterBiomes([FOREST]);
        $c = 0;
        foreach ($biomes as $pId => $locations) {
          $c += count($locations);
        }

        if ($c > 0) {
          $this->insertAsChild(FT::GAIN($card->getId(), BOOST, $c));
        }
        break;
      case 'eachPlayerAsleep':
        $nodes = [];
        $turnOrder = Players::getTurnOrder(Players::getActiveId());
        foreach ($turnOrder as $pId) {
          $nodes[] = FT::ACTION(
            TARGET,
            [
              'targetType' => [CHARACTER, TOKEN],
              'targetPlayer' => ME,
              // 'excludedStatuses' => [ASLEEP],
              'effect' => FT::GAIN(EFFECT, ASLEEP)
            ],
            ['pId' => $pId, 'sourceId' => $this->getSourceId()]
          );
        }

        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      // Bise
      case 'boostReserve':
        $player = Players::getActive();
        $nodes = [];
        foreach ($player->getReserveCards() as $cId => $card) {
          if ($card->getType() != CHARACTER) {
            continue;
          }
          $nodes[] = FT::ACTION(GAIN, ['cardId' => $cId, 'type' => BOOST], ['sourceId' => $this->getSourceId()]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'boostXBoostedChar';
        $n = $card
          ->getPlayer()
          ->getPlayedCards([CHARACTER, TOKEN])
          ->filter(function ($c) {
            return $c->hasToken(BOOST);
          })
          ->count();
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boostXAnchoredChar';
        $n = $card
          ->getPlayer()
          ->getPlayedCards([CHARACTER, TOKEN])
          ->filter(function ($c) {
            return $c->hasToken(ANCHORED);
          })
          ->count();
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boostXreserveBoost':
        $boost = $this->getEvent()['boost'] ?? 0;
        $nodes = [];
        for ($i = 0; $i < $boost; $i++) {
          $nodes[] = FT::ACTION(TARGET, [
            'targetLocation' => [RESERVE],
            'targetPlayer' => ME,
            'excludeSelf' => true,
            'effect' => FT::GAIN(EFFECT, BOOST)
          ], ['sourceId' => $this->getSourceId()]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'augmentXreserveBoost':
        $boost = $this->getEvent()['boost'] ?? 0;
        $nodes = [];
        for ($i = 0; $i < $boost; $i++) {
          $nodes[] = FT::ACTION(TARGET, [
            'targetType' => [CHARACTER, SPELL, PERMANENT],
            'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE],
            'upTo' => true,
            'augmentOnly' => true,
            'effect' => FT::AUGMENT($this)
          ]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'boostXMana':
        $n = $card
          ->getPlayer()
          ->getTotalMana();
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'boostedRevealBaseStat':
        $bypass = $args['bypass'] ?? false;
        if ($card->countToken(BOOST) > 0 || $bypass) {
          Engine::checkpoint();
          $player = $card->getPlayer();
          $drawn = $player->draw(1, null, LIMBO, $card)->first();

          $baseStat = false;
          foreach ($drawn->getBiomes() as $biome => $value) {
            if ($value == 0) {
              $baseStat = true;
            }
          }
          if ($drawn->getType() != CHARACTER) {
            $baseStat = false;
          }
          if ($baseStat == true) {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['destination' => HAND, 'cardId' => $drawn->getId()])
            );
            $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
          } else {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['cardId' => $drawn->getId()])
            );
          }
        }
        break;
      case 'boostedRevealArtistSong':
        $bypass = $args['bypass'] ?? false;
        if ($card->countToken(BOOST) > 0 || $bypass) {
          Engine::checkpoint();
          $player = $card->getPlayer();
          $drawn = $player->draw(1, null, LIMBO, $card)->first();

          $baseStat = false;
          if (in_array(ARTIST, $drawn->getSubtypes()) || in_array(SONG, $drawn->getSubtypes())) {
            $baseStat = true;
          }
          if ($baseStat == true) {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['destination' => HAND, 'cardId' => $drawn->getId()])
            );
            $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
          } else {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['cardId' => $drawn->getId()])
            );
          }
        }
        break;
      case 'boostedRevealRobotPermanent':
        $bypass = $args['bypass'] ?? false;
        if ($card->countToken(BOOST) > 0 || $bypass) {
          Engine::checkpoint();
          $player = $card->getPlayer();
          $drawn = $player->draw(1, null, LIMBO, $card)->first();

          $baseStat = false;
          if (in_array(ROBOT, $drawn->getSubtypes()) || $drawn->getType() == PERMANENT || in_array(PERMANENT, $drawn->getAdditionalType())) {
            $baseStat = true;
          }
          if ($baseStat == true) {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['destination' => HAND, 'cardId' => $drawn->getId()])
            );
            $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
          } else {
            $this->insertAsChild(
              FT::ACTION(DISCARD, ['cardId' => $drawn->getId()])
            );
          }
        }
        break;
      case 'ManInTheMaze':
        $cards = Cards::getPlayedCards(null, [CHARACTER, TOKEN])->merge(Cards::getReserveCards(null, [CHARACTER, TOKEN]));
        $deleted = [];
        foreach ($cards as $lId => $lCard) {
          $meeples = Meeples::getInLocation('card-' . $lId)->where('type', BOOST);
          $meepleIds = $meeples->getIds();
          if (!empty($meepleIds)) {
            Meeples::delete($meepleIds);
            $deleted = array_merge($deleted, $meepleIds);
            Notifications::looseMeeples(BOOST, $lCard, $meeples, false);
          }
        }
        switch (count($deleted)) {
          case 0:
            break;
          case 1:
          case 2:
          case 3:
          case 4:
            $this->insertAsChild(FT::GAIN($card->getId(), BOOST, 2));
            break;
          case 5:
          case 6:
          case 7:
          case 8:
            $this->insertAsChild(FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'maxHandCost' => 3, 'free' => true], ['sourceId' => $this->getSourceId()]));
            break;
          case 9:
          default:
            $this->insertAsChild(FT::ACTION(MOVE_EXPEDITION, ['expedition' => [EFFECT], 'pId' => $card->getPId()], ['sourceId' => $this->getSourceId()]));
            break;
        }
        break;
      case 'ManInTheMazeRare':
        $cards = Cards::getPlayedCards(null, [CHARACTER, TOKEN])->merge(Cards::getReserveCards(null, [CHARACTER, TOKEN]));
        $deleted = [];
        foreach ($cards as $lId => $lCard) {
          $meeples = Meeples::getInLocation('card-' . $lId)->where('type', BOOST);;
          $meepleIds = $meeples->getIds();
          if (!empty($meepleIds)) {
            Meeples::delete($meepleIds);
            $deleted = array_merge($deleted, $meepleIds);
            Notifications::looseMeeples(BOOST, $lCard, $meeples, false);
          }
        }
        $nodes = [];
        if (count($deleted) >= 1) {
          $nodes[] = FT::GAIN($card->getId(), BOOST, 2);
        }
        if (count($deleted) >= 5) {
          $nodes[] = FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'maxHandCost' => 3, 'free' => true], ['sourceId' => $this->getSourceId()]);
        }
        if (count($deleted) >= 9) {
          $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['expedition' => [EFFECT], 'pId' => $card->getPId()], ['sourceId' => $this->getSourceId()]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_PARALLEL,  'noIndependent' => true, 'childs' => $nodes]);
        }
        break;
      case 'ManInTheMazeYzmir':
        $cards = Cards::getPlayedCards(null, [CHARACTER, TOKEN])->merge(Cards::getReserveCards(null, [CHARACTER, TOKEN]));
        $deleted = [];
        foreach ($cards as $lId => $lCard) {
          $meeples = Meeples::getInLocation('card-' . $lId)->where('type', BOOST);;
          $meepleIds = $meeples->getIds();
          if (!empty($meepleIds)) {
            Meeples::delete($meepleIds);
            $deleted = array_merge($deleted, $meepleIds);
            Notifications::looseMeeples(BOOST, $lCard, $meeples, false);
          }
        }
        switch (count($deleted)) {
          case 0:
            break;
          case 1:
          case 2:
          case 3:
          case 4:
            $this->insertAsChild(FT::GAIN($card->getId(), BOOST, 2));
            break;
          case 5:
          case 6:
          case 7:
          case 8:
            $this->insertAsChild(FT::ACTION(CHOOSE_ASSIGNMENT, ['actions' => ['play'], 'maxHandCost' => 3, 'free' => true], ['sourceId' => $this->getSourceId()]));
            break;
          case 9:
          default:
            $this->insertAsChild(FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'expedition' => [EFFECT], 'pId' => OPPONENT], ['sourceId' => $this->getSourceId()]));
            break;
        }
        break;
      case 'manInTheMazeUnique':
        $cards = Cards::getPlayedCards(null, [CHARACTER, TOKEN])->merge(Cards::getReserveCards(null, [CHARACTER, TOKEN]));
        $deleted = [];
        foreach ($cards as $lId => $lCard) {
          $meeples = Meeples::getInLocation('card-' . $lId)->where('type', BOOST);;
          $meepleIds = $meeples->getIds();
          if (!empty($meepleIds)) {
            Meeples::delete($meepleIds);
            $deleted = array_merge($deleted, $meepleIds);
            Notifications::looseMeeples(BOOST, $lCard, $meeples, false);
          }
        }
        $nodes = [];
        if (count($deleted) >= 1) {
          $nodes[] = $args['1+'];
        }
        if (count($deleted) >= 4) {
          $nodes[] = $args['4+'];
        }
        if (count($deleted) >= 9) {
          $nodes[] = $args['9+'];
        }
        if (!empty($nodes)) {
          foreach ($nodes as &$node) {
            $node['sourceId'] = $this->getSourceId();
            $node['pId'] = $card->getPId();
            if (isset($node['childs'])) {
              $node = Utils::tagTree($node, ['sourceId' => $this->getSourceId(), 'pId' => $card->getPId()]);
            }
          }
          // $nodes = Utils::tagTree($nodes, ['sourceId' => $this->getSourceId(), 'pId' => $card->getPId()]);
          // throw new \feException(print_r($nodes));
          $this->insertAsChild(['type' => NODE_PARALLEL, 'noIndependent' => true, 'childs' => $nodes]);
        }
        break;
      case 'removeFleetingCharacterStat0Played':
        Globals::setRemoveFleetingCharacterStat0Played(true);
        break;
      case 'removeFleetingSongArtistPlayed':
        Globals::setRemoveFleetingSongArtistPlayed(true);
        break;
      case 'doubleBoosts':
        $player = $card->getPlayer();
        $nodes = [];
        foreach ($player->getReserveCards()->merge($player->getPlayedCards()) as $bId => $bCard) {
          if ($bCard->hasToken(BOOST)) {
            $nodes[] = FT::GAIN($bId, BOOST, $bCard->countToken(BOOST));
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'counterPerCharacter':
        $player = $card->getPlayer();
        if ($effect == 'counterPerOpponentCharacter') {
        }
        $count = $player->getPlayedCards()->filter(function ($c) {
          return in_array($c->getType(), [TOKEN, CHARACTER]);
        })->count();
        if ($count > 0) {
          $data = $card->getExtraDatas();
          $data['counter'] = ($data['counter'] ?? 0) + $count;
          $card->setExtraDatas($data);

          Notifications::gainCounter($this->getSource(), $count);
          $this->checkAfterListeners($card->getPlayer(), ['sourceId' => $card->getId(), 'specialEffect' => 'gainCounter']);
        }
        break;
      case 'nextCharacterVGainsBoost':
        Globals::incNextCharacterBoostV(1);
        Globals::incNextCharacterBoostOccurence(1);
        break;
      case 'boostAndRemoveFromExpedition':
        $player = $card->getPlayer();
        $expeditionCards = $player->getPlayedCards()->filter(function ($c) use ($card) {
          return in_array($c->getType(), [TOKEN, CHARACTER]) &&
            ($card->getLocation() == $c->getLocation() || ($card->isGigantic() && in_array($c->getLocation(), STORMS))) &&
            $card->getId() != $c->getId();
        });
        if ($expeditionCards->count() > 0) {
          $nodes = [];
          foreach ($expeditionCards as $eId => $expCard) {
            $nodes[] = FT::ACTION(DISCARD, ['destination' => RESERVE, 'cardId' => $eId], ['sourceId' => $card->getId()]);
          }
          $this->insertAsChild(
            FT::SEQ(
              FT::GAIN($card->getId(), BOOST, $expeditionCards->count()),
              ['type' => NODE_SEQ, 'childs' => $nodes]
            )
          );
        }
        break;
      case 'invokeXRecruitReserve':
        $player = $this->getCtxArg('pId');
        $expedition = $this->getCtxArg('expedition');
        $n = Players::get($player)->getReserveCards()->count();
        if ($n > 0) {
          $this->insertAsChild(FT::ACTION(INVOKE_TOKEN, [
            'pId' => $this->getCtxArg('player'),
            'tokenType' => 'OD_Common_OrdisRecruit',
            'n' => $n,
            'targetLocation' => [$expedition],
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'RunesTestamentLook4':
        Engine::checkpoint();
        // draw 4 cards
        $player = $card->getPlayer();
        $drawn = $player->draw(4, null, null, $card);
        // Target only Characters drawn
        $this->insertAsChild(
          FT::ACTION(
            TARGET,
            [
              'n' => 1,
              'targetLocation' => [HAND],
              'targetType' => [PERMANENT, SPELL, CHARACTER],
              'targetPlayer' => ME,
              'cards' => $drawn->getIds(),
              'discardRemaining' => true,
            ],
            ['sourceId' => $card->getId()]
          )
        );
        break;
      case 'invokeRecruitBehind':
      case 'invokeBrassbugBehind':
        $winners = Players::getWinningPlayerByStorms();
        $nodes = [];
        $invoke = 'OD_Common_OrdisRecruit';
        if ($effect == 'invokeBrassbugBehind') {
          $invoke = 'AX_Common_Brassbug';
        }
        foreach (STORMS as $storm) {
          $win = $winners[$storm] ?? null;
          if (((is_null($win) || $win == -1 || $win != $card->getPId()) && !Globals::isTieBreakerMode())  ||
            Globals::isTieBreakerMode() || $card->getPlayer()->hasOverrideBehind($storm)
          ) {
            $nodes[] = FT::ACTION(
              INVOKE_TOKEN,
              [
                'pId' => $card->getPId(),
                'tokenType' => $invoke,
                'targetLocation' => [$storm],
              ],
              ['sourceId' => $card->getId()]
            );
          }
        }

        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'counterPerOpponentCharacter':
        $player = $card->getPlayer();
        $count = Players::getNext($player)->getPlayedCards()->filter(function ($c) {
          return in_array($c->getType(), [TOKEN, CHARACTER]);
        })->count();
        if ($count > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => ME,
            'type' => BOOST,
            'n' => $count
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'boostHandCards':
        $player = $card->getPlayer();
        $count = $player->getHand()->count();
        if ($count > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => ME,
            'type' => BOOST,
            'n' => $count
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'boostReserveCards':
        $player = $card->getPlayer();
        $count = $player->getReserveCards()->count();
        if ($count > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => ME,
            'type' => BOOST,
            'n' => $count
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'doCounter1':
        $count = ($card->getExtraDatas()['counter'] ?? 0) + 1;
        $nodes = [];
        $effect = $args['effect'];
        $effect['pId'] = $card->getPlayer()->getId();
        for ($i = 0; $i < $count; $i++) {
          $nodes[] = $effect;
        }
        $nodes = Utils::tagTree(['childs' => $nodes], ['sourceId' => $card->getId()]);
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes['childs']]);
        }
        break;
      case 'doEachBoost':
        $count = $this->getEvent()['boost'] ?? 0;
        $nodes = [];
        $effect = $args['effect'];
        $effect['pId'] = $card->getPlayer()->getId();
        for ($i = 0; $i < $count; $i++) {
          $nodes[] = $effect;
        }
        $nodes = Utils::tagTree(['childs' => $nodes], ['sourceId' => $card->getId()]);
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes['childs']]);
        }
        break;
      case 'revealTop':
        Engine::checkpoint();
        $player = $card->getPlayer();
        $pId = $player->getId();
        if (Cards::countInLocation("reveal-$pId") == 0) {
          $draw = $player->draw(1, null, 'reveal-' . $player->getId(), $this->getSource(), clienttranslate('${player_name} reveals ${card_names} from its deck (${card_name2}\'s effect)'), clienttranslate('${you} reveals ${card_names} from its deck (${card_name2}\'s effect)'));
        }

        break;
      case 'drawReveal':
        $player = $card->getPlayer();
        $pId = $player->getId();
        $done = false;

        $draw = Cards::getInLocation("reveal-$pId");
        foreach ($draw as $dId => $drawn) {
          $drawn->setLocation('hand');
        }
        Notifications::silentKill([], $draw->getIds());
        Notifications::drawCards($player, Cards::getMany($draw->getIds()));
        $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
        break;
      case 'drawTopIfRoll':
        $player = $card->getPlayer();
        $pId = $player->getId();
        $done = false;

        $selectedRoll = $this->getCtx()->toArray()['event']['selectedRoll'] ?? $this->getCtxArg('roll');
        $draw = Cards::getInLocation("reveal-$pId");
        foreach ($draw as $dId => $drawn) {
          if ($selectedRoll == $drawn->getCostHand()) {
            $drawn->setLocation('hand');
            $done = true;
          }
        }
        if ($done) {
          Notifications::silentKill([], $draw->getIds());
          Notifications::drawCards($player, Cards::getMany($draw->getIds()));
          $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
        }
        break;
      case 'exhaustPlayFree':
        $player = $card->getPlayer();
        $pId = $player->getId();
        $done = false;
        $nodes = [];

        $selectedRoll = $this->getCtx()->toArray()['event']['selectedRoll'];
        $draw = Cards::getInLocation("reveal-$pId");
        foreach ($draw as $dId => $drawn) {
          if ($selectedRoll == $drawn->getCostHand()) {
            $nodes[] = FT::ACTION(TAP, ['cardId' => $card->getId()], ['sourceId' => $card->getId()]);
            $nodes[] = FT::ACTION(
              PLAY_CARD,
              [
                'cardId' => $drawn->getId(),
                'free' => true,
                'effectHand' => false,
              ],
              ['sourceId' => $card->getId()]
            );
            $done = true;
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'hunger':
        $toDiscard = Cards::getAll()->filter(function ($c) {
          return in_array($c->getLocation(), [STORM_RIGHT, STORM_LEFT, LANDMARK, RESERVE]);
        });
        $players = Players::getAll();
        $floralTents = [];
        $nodes = [];
        foreach ($players as $tId => $tPlayer) {
          if ($tPlayer->hasProtectBoostedInExpedition(STORM_LEFT)) {
            $floralTents['boosted'][$tId][STORM_LEFT] = true;
          }
          if ($tPlayer->hasProtectBoostedInExpedition(STORM_RIGHT)) {
            $floralTents['boosted'][$tId][STORM_RIGHT] = true;
          }
          if ($tPlayer->hasProtectAnchoredInExpedition(STORM_LEFT)) {
            $floralTents['anchored'][$tId][STORM_LEFT] = true;
          }
          if ($tPlayer->hasProtectAnchoredInExpedition(STORM_RIGHT)) {
            $floralTents['anchored'][$tId][STORM_RIGHT] = true;
          }
        }

        foreach ($toDiscard as $dId => $dCard) {
          $dPId = $dCard->getPId();

          if ($dId == $card->getId()) {
            continue;
          }

          if (in_array($dCard->getLocation(), STORMS) && $dCard->hasToken(BOOST) && in_array($dCard->getType(), [TOKEN, CHARACTER])) {
            $otherExpedition = $dCard->getLocation() == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;
            if (isset($floralTents['boosted'][$dPId][$dCard->getLocation()]) || ($dCard->isGigantic() && isset($floralTents['boosted'][$dPId][$otherExpedition]))) {
              // unset($toDiscard[$dId]);
              Notifications::message(clienttranslate('${card_name} is not discarded but loose <BOOST> instead'), ['card' => $dCard]);
              $nodes[] = ['action' => LOOSE, 'args' => ['cardId' => $dId, 'type' => BOOST, 'n' => 99]];
              continue;
            }
          }

          if (in_array($dCard->getLocation(), STORMS) && $dCard->hasToken(ANCHORED) && in_array($dCard->getType(), [TOKEN, CHARACTER])) {
            $otherExpedition = $dCard->getLocation() == STORM_LEFT ? STORM_RIGHT : STORM_LEFT;
            if (isset($floralTents['anchored'][$dPId][$dCard->getLocation()]) || ($dCard->isGigantic() && isset($floralTents['anchored'][$dPId][$otherExpedition]))) {
              // unset($toDiscard[$dId]);
              Notifications::message(clienttranslate('${card_name} is not discarded but loose <ANCHORED> instead'), ['card' => $dCard]);
              $nodes[] = ['action' => LOOSE, 'args' => ['cardId' => $dId, 'type' => ANCHORED]];
              continue;
            }
          }
          $nodes[] = FT::ACTION(DISCARD, ['cardId' => $dId]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }

        break;
      case 'reveal':
        $toReveal = $this->getCard();
        $toReveal->setLocation(LIMBO);
        Notifications::reveal($toReveal, $card);
        // Interrupt to check that player saw the card
        $this->insertAsChild(FT::ACTION(INTERUPT_REVEAL, [], ['pId' => Players::getNext(Players::getActive())->getId()]));
        break;
      case 'ascend':
        $player = $this->getCtxArg('pId') ?? $card->getPlayer()->getId();
        $player = $this->getCtxArg('player') ?? $player;
        $expedition = $this->getCtxArg('expedition');
        $oPlayer = Players::get($player);
        $resupplyIfAscended = $oPlayer->hasResupplyIfAscended();
        // manage my expedition
        if ($expedition == 'source') {
          $expedition = $card->getLocation();
        }

        $side = $expedition == STORM_LEFT ? HERO : COMPANION;
        if ($resupplyIfAscended && $oPlayer->isAscended($expedition)) {
          $this->insertAsChild(FT::ACTION(RESUPPLY, []));
        } elseif (!$oPlayer->isAscended($expedition)) {
          // $token = $expedition == STORM_LEFT ? 'getHeroToken' : 'getCompanionToken';
          // $oToken = $oPlayer->$token();
          $ascended = Meeples::singleCreate([
            'player_id' => $player,
            'location' => $expedition,
            'nbr' => 1,
            'type' => 'ascend'
          ]);
          Notifications::ascend($ascended, $oPlayer, $card, $expedition);
        }
        break;
      case 'switchPlayer':
        $newFirstPId = $this->getCtxArgs()['pId'];
        Globals::setFirstPlayer($newFirstPId);
        Notifications::switchPlayer(Players::get($newFirstPId));
        break;
      case 'allCharacterFleeting':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          foreach ($player->getPlayedCards() as $cId => $card) {
            if (!in_array($card->getType(), [CHARACTER, TOKEN]) || $card->hasToken(FLEETING)) {
              continue;
            }
            $nodes[] = FT::GAIN($cId, FLEETING);
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'allOtherCharacterFleeting':
        $nodes = [];
        foreach (Players::getAll() as $pId => $player) {
          foreach ($player->getPlayedCards() as $cId => $card) {
            if (!in_array($card->getType(), [CHARACTER, TOKEN]) || $card->hasToken(FLEETING) || $card->getId() == $this->getSourceId()) {
              continue;
            }
            $nodes[] = FT::GAIN($cId, FLEETING);
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'allPass':
        $nodes = [];
        $skipped = Globals::getSkippedPlayers();
        foreach (Players::getTurnOrder($card->getPId()) as $pId) {
          if (!isset($skipped[$pId])) {
            $nodes[] = FT::ACTION(END_AFTERNOON, [], ['pId' => $pId]);
          }
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'boostTargetReserveCards':
        $player = $card->getPlayer();
        $count = $player->getReserveCards()->count();
        if ($count > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => $this->getCard()->getId(),
            'type' => BOOST,
            'n' => $count
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'drawRevealed':
        $player = $card->getPlayer();
        $pId = $player->getId();
        $type = $args['type'];
        $reserve = $args['reserve'] ?? null;
        $done = false;
        $resupply = false;

        $draw = Cards::getInLocation("reveal-$pId");
        foreach ($draw as $dId => $drawn) {
          if ($type == $drawn->getType() || in_array($type, $drawn->getAdditionalType())) {
            $drawn->setLocation('hand');
            $done = true;
          } elseif ($reserve == $drawn->getType() || in_array($reserve, $drawn->getAdditionalType())) {
            $drawn->setLocation(RESERVE);
            $resupply = true;
          }
        }
        if ($done) {
          Notifications::silentKill([], $draw->getIds());
          Notifications::drawCards($player, Cards::getMany($draw->getIds()));
          $this->checkAfterListeners($player, ['draw' => 1, 'location' => HAND], true, 'Draw');
        }
        if ($resupply) {
          Notifications::silentKill([], $draw->getIds());
          Notifications::drawCards($player, Cards::getMany($draw->getIds()), clienttranslate('${player_name} places ${card_names} from its deck to Reserve (${card_name2}\'s effect)'), clienttranslate('You put ${card_names} from your deck in Reserve (${card_name2}\'s effect)'), ['card2' => $card], true);
          $this->checkAfterListeners($player, ['draw' => 1, 'sourceId' => $this->getSourceId(), 'notResupply' => false], true, 'Resupply');
          // $this->checkAfterListeners($player, ['draw' => 1, 'location' => RESERVE], true, 'Draw');
        }
        break;
      case 'boostXOpponentExpedition':
        $player = $card->getPlayer();
        $expedition = $card->getLocation();
        $count = Players::getNext($player)->getPlayedCards()->filter(function ($c) use ($expedition) {
          return in_array($c->getType(), [TOKEN, CHARACTER]) && in_array($c->getLocation(), STORMS);
        })->count();
        if ($count > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => ME,
            'type' => BOOST,
            'n' => $count
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'globalTough':
        $globalTough = Globals::getGlobalTough();
        $globalTough[$card->getPId()][] = $args;
        Globals::setGlobalTough($globalTough);
        break;
      case 'nextTokenAsleep':
        Globals::setNextTokenAsleep(true);
        break;
      case 'boostReserveSubtype':
        $player = Players::getActive();
        $subType = $args['subType'];
        $nodes = [];
        foreach ($player->getReserveCards() as $cId => $card) {
          if (!in_array($subType, $card->getSubtypes())) {
            continue;
          }
          $nodes[] = FT::ACTION(GAIN, ['cardId' => $cId, 'type' => BOOST], ['sourceId' => $this->getSourceId()]);
        }
        if (!empty($nodes)) {
          $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        }
        break;
      case 'doppelganger':
        // throw new \feException(print_r($this->getCtxArgs()));
        $extra = $card->getExtraDatas();
        $extra['subtypes'] = $card->getSubtypes();
        $extra['typeline'] = $card->getTypeline();
        $card->setSubtypes(Cards::get($this->getCtxArgs()['cardId'])->getSubtypes());
        $card->setTypeline(Cards::get($this->getCtxArgs()['cardId'])->getTypeline());

        $card->setExtraDatas($extra);
        Notifications::refreshCard($card);
        // Gain boost
        $max = 0;
        $biomes = Cards::get($this->getCtxArgs()['cardId'])->getBiomes(true);
        foreach ($biomes as $b => $value) {
          if ($value > $max) {
            $max = $value;
          }
        }
        if ($max > 0) {
          $this->insertAsChild(FT::ACTION(GAIN, [
            'cardId' => $card->getId(),
            'type' => BOOST,
            'n' => $max
          ], ['sourceId' => $card->getId()]));
        }
        break;
      case 'resetCard':
        $extra = $card->getExtraDatas();
        $card->setSubtypes($extra['subtypes']);
        $card->setTypeline($extra['typeline']);
        Notifications::refreshCard($card);

        break;
      case 'defect':
        $defectCard = $this->getCard();
        // TODO: multiplayer
        $newPId = Players::getNextId($defectCard->getPlayer());
        $extraDatas = $defectCard->getExtraDatas();
        if (isset($args['takeControl']) && $args['takeControl'] == true) {
          $newPId = $card->getPId();
        }

        if (!isset($extraDatas['pId'])) {
          $extraDatas['pId'] = $defectCard->getPId();
        }
        if (isset($args['moveToMe']) && $args['moveToMe'] == true && !in_array(LANDMARK, $defectCard->getSubtypes())) {
          $defectCard->setLocation($card->getLocation());
        }
        $defectCard->setExtraDatas($extraDatas);
        $defectCard->setPId($newPId);
        Notifications::defect($defectCard, $defectCard->getPlayer(), $card);
        $this->checkAfterListeners($defectCard->getPlayer(), [
          'cardId' => $defectCard->getId(),
          'playCard' => true,
          'cardType' => $defectCard->getType(),
          'additionalType' => $defectCard->getAdditionalType(),
          'cardSubtypes' => $defectCard->getSubtypes(),
          'from' => $defectCard->getLocation(),
          'to' => $defectCard->getLocation(),
          'locationPId' => $defectCard->getPId(),
          'token' => $defectCard->isToken(),
          'defect' => true,
        ], true, 'MoveCard');
        break;
      case 'discardAllAndBackward':
        // Sakarabru's fury
        $player = Players::get($this->getArg('player'));
        $expedition = $this->getArg('expedition');
        $nodes = [];
        foreach ($player->getPlayedCards() as $cId => $card) {
          if ($card->getType() != CHARACTER) {
            continue;
          }
          if ($card->getLocation() == $expedition || (in_array($expedition, STORMS) && $card->isGigantic())) {
            $nodes[] = FT::ACTION(DISCARD, ['cardId' => $cId], ['sourceId' => $this->getSourceId()]);
          }
        }
        $nodes[] = FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'forceExpedition' => [$player->getId(), $expedition]]);
        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      /////// DUSTER /////////////////////////////////////
      case 'boostXExhaustedMax3':
        $n = 0;
        $cards = $card
          ->getPlayer()
          ->getPlayedCards(PERMANENT);

        $cards = $cards->filter(fn($c) => $c->isTapped());
        $n += $cards->count();

        $cards = $card
          ->getPlayer()
          ->getReserveCards();
        $cards = $cards->filter(fn($c) => $c->isTapped());
        $n += $cards->count();

        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n, 3));
        }
        break;
      case 'nextCharactInExpeditionBoost':
        // throw new \feException(print_r($this->getCtx()->getParent()->toArray()));
        $n = $args['n'] ?? 1;
        if (($args['X'] ?? '') == 'paidMana') {
          $n = $this->getCtx()->getParent()->toArray()['childs'][0]['actionResolutionArgs'][0];
        }
        // throw new \feException($n);
        $boosts = Globals::getNextCharacterInExpeditionBoost();
        $boosts[$card->getPId()][$card->getLocation()] = $n + ($boosts[$card->getPId()][$card->getLocation()] ?? 0);
        Globals::setNextCharacterInExpeditionBoost($boosts);
        Notifications::message(clienttranslate('${player_name} will boost next character played in ${card_name}\'s expedition'), [
          'player' => Players::getActive(),
          'card' => $card
        ]);
        break;
      case 'Phoibos':
        // Reveal random card
        $player = $card->getPlayer();
        $opponent = Players::getNext($player);
        $opponentHand = $opponent->getHand();
        if ($opponentHand->count() > 0) {
          $revealedCard = $opponentHand->rand();
          $revealedCard->setLocation(LIMBO);
          Notifications::revealHand($revealedCard, $card);
          if (Conditions::isInContact($card, [])) {
            // if in contact, may play
            $this->insertAsChild(FT::XOR(
              FT::SEQ(
                FT::GAIN($revealedCard->getId(), FLEETING),
                FT::ACTION(
                  PLAY_CARD,
                  [
                    'cardId' => $revealedCard->getId(),
                    'free' => true,
                    'stealOwnership' => true,
                  ],
                  ['sourceId' => $card->getId()]
                ),
              ),
              FT::ACTION(DISCARD, ['cardId' => $revealedCard->getId()])
            ));
          } else {
            // else (or not played) discard
            $this->insertAsChild(FT::ACTION(DISCARD, ['cardId' => $revealedCard->getId()]));
          }
        }
        break;
      case 'PhoibosUnique':
        // Reveal random card
        $player = $card->getPlayer();
        $opponent = Players::getNext($player);
        $opponentHand = $opponent->getHand();
        if ($opponentHand->count() > 0) {
          $revealedCard = $opponentHand->rand();
          $revealedCard->setLocation(LIMBO);
          Notifications::revealHand($revealedCard, $card);
          // if in contact, may play
          $this->insertAsChild(FT::XOR(
            FT::SEQ(
              FT::GAIN($revealedCard->getId(), FLEETING),
              FT::ACTION(
                PLAY_CARD,
                [
                  'cardId' => $revealedCard->getId(),
                  'free' => true,
                  'stealOwnership' => true,
                ],
                ['sourceId' => $card->getId()]
              ),
            ),
            FT::ACTION(DISCARD, ['cardId' => $revealedCard->getId()])
          ));
        }
        break;
      case 'RomanticEncounter':
        Engine::checkpoint();
        // draw 4 cards

        $player = $card->getPlayer();
        if ($args['player'] == ME) {
          $opponent = $player;
        } else {
          $opponent = Players::getNext($player);
        }
        $drawn = $opponent->draw(4, null, LIMBO, $card);

        // Target only Characters drawn
        $this->insertAsChild(
          FT::SEQ(
            FT::ACTION(
              TARGET,
              [
                'n' => 1,
                'upTo' => true,
                'effect' => FT::SEQ(FT::ACTION(PLAY_CARD, ['free' => true, 'stealOwnership' => true, 'effectHand' => false]), FT::GAIN(EFFECT, FLEETING)),
                'targetLocation' => [LIMBO],
                'targetPlayer' => ME,
                'cards' => $drawn->getIds(),
                'maxBaseCost' => ($args['rare'] ?? false) ? 3 : INFTY,
                // 'discardRemaining' => true,
              ],
              ['sourceId' => $card->getId()]
            ),
            FT::ACTION(SPECIAL_EFFECT, ['effect' => 'RomanticCleanLimbo', 'args' => ['cards' => $drawn->getIds()]], ['sourceId' => $card->getId()])
          )
        );

        break;
      case 'RomanticEncounterRare':
        $nodes = [];
        $nodes[] = FT::ACTION(SPECIAL_EFFECT, ['effect' => 'RomanticEncounter', 'args' => ['player' => ME, 'rare' => true]], ['sourceId' => $card->getId()]);
        $nodes[] = FT::ACTION(SPECIAL_EFFECT, ['effect' => 'RomanticEncounter', 'args' => ['player' => OPPONENT, 'rare' => true]], ['sourceId' => $card->getId()]);
        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      case 'RomanticCleanLimbo':
        $discard = [];
        $player = Players::getActive();
        foreach ($args['cards'] as $cId) {
          if ($cId != $card->getId() && Cards::get($cId)->getLocation() == LIMBO) {
            $discard[] = $cId;
            Cards::discard($cId);
            $this->checkAfterListeners($player, [
              'discardCard' => true,
              'cardsToListen' => [], // we add the discarded cards as they should react even if not played
              'cardId' => $cId,
              'token' => false,
              'from' => LIMBO,
              'to' => DISCARD_PILE,
              'sacrifice' => false,
              'sourceId' => $this->getSourceId(),
              'pId' => $player->getId(),
            ], true, 'Discard');
          }
        }

        Notifications::publicDiscard(
          $card->getPlayer(),
          Cards::getMany($discard),
          clienttranslate('${player_name} discards ${card_names} as they are not targeted'),
          [
            'source' => LIMBO,
            'hand' => false,
            'destination' => DISCARD,
          ]
        );
        break;
      case 'copyGift':
        $event = $this->getEventRecursive();

        if ($event['action'] == 'InvokeToken') {
          $this->insertAsChild(FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => $event['invoked'],
            'targetLocation' => $event['to'] == LANDMARK ? [LANDMARK] : STORMS,
            'targetPlayer' => ME,
          ], ['sourceId' => $card->getId()]));
        } elseif ($event['action'] == 'Draw') {
          $this->insertAsChild(FT::ACTION(DRAW, ['n' => 1, 'players' => ME], ['sourceId' => $card->getId()]));
        } elseif ($event['action'] == 'Resupply') {
          $this->insertAsChild(FT::ACTION(RESUPPLY, ['n' => 1, 'exhausted' => $event['exhausted']], ['sourceId' => $card->getId()]));
        }
        break;
      case 'nextCharacterBaseCost3Anchored':
        Globals::setNextCharacterBaseCost3Anchored(true);
        break;
      case 'boostXLandmarkMax3':
        $n = $card
          ->getPlayer()
          ->getLandmarks()
          ->count();
        $n = min((3 - $card->countToken(BOOST)), $n);
        if ($n > 0) {
          $this->insertAsChild(FT::GAIN($card, BOOST, $n));
        }
        break;
      case 'sacrificeHighestCharacter':
      case 'sacrificeHighestCharacterPermanent':
        $opponent = Players::getNext($card->getPlayer());
        if ($effect == 'sacrificeHighestCharacterPermanent') {
          $targets = [CHARACTER, PERMANENT];
        } else {
          $targets = [CHARACTER];
        }
        $cards = $opponent->getPlayedCards()->filter(function ($c) use ($targets) {
          return in_array($c->getType(), $targets);
        });
        $maxCost = 0;
        $maxIds = [];


        foreach ($cards as $oId => $oCard) {
          if ($oCard->hasToken(FLEETING)) {
            $cost = $oCard->getCostReserve();
          } else {
            $cost = $oCard->getCostHand();
          }
          if ($maxCost < $cost) {
            $maxCost = $cost;
            $maxIds = [];
            $maxIds[] = $oId;
          } elseif ($maxCost == $cost) {
            $maxIds[] = $oId;
          }
        }
        if (empty($maxIds)) {
          return [];
        } elseif (count($maxIds) == 1) {
          $this->insertAsChild(FT::ACTION(DISCARD, ['cardId' => $maxIds[0], 'desc' => 'sacrifice'], ['pId' => $opponent->getId(), 'sourceId' => $card->getId()]));
        } else {
          $this->insertAsChild(FT::ACTION(TARGET, [
            'effect' => FT::ACTION(DISCARD, ['cardId' => $maxIds[0], 'desc' => 'sacrifice']),
            'cards' => $maxIds,
            'targetType' => $targets,
          ], ['pId' => $opponent->getId(), 'sourceId' => $card->getId()]));
        }
        break;
      case "tiktok":
        $activePlayer = Players::getActive();
        $player = $activePlayer;
        $nodes = null;
        do {
          $nodes[] = [
            'type' => NODE_XOR,
            'pId' => $player->getId(),
            'sourceId' => $card->getId(),
            'childs' => [
              FT::ACTION(TARGET, [
                'targetType' => [PERMANENT],
                'targetPlayer' => ME,
                'isNotTapped' => true,
                'sourceId' => $card->getId(),
                'effect' => FT::SEQ(
                  FT::ACTION(EXHAUST, ['cardId' => EFFECT], ['sourceId' => $card->getId()]),
                )
              ], ['sourceId' => $card->getId()]),
              FT::ACTION(TARGET, [
                'targetType' => [SPELL, CHARACTER, PERMANENT],
                'targetPlayer' => ME,
                'isNotTapped' => true,
                'targetLocation' => [RESERVE],
                'effect' => FT::SEQ(
                  FT::ACTION(EXHAUST, ['cardId' => EFFECT], ['sourceId' => $card->getId()]),
                )
              ], ['sourceId' => $card->getId(),])
            ]
          ];
          $player = Players::getNext($player);
        } while ($player->getId() != $activePlayer->getId());
        $this->insertAsChild(['type' => NODE_SEQ, 'childs' => $nodes]);
        break;
      default:
        break;
    }

    $this->resolveAction([]);
  }
}

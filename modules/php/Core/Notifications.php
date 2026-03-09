<?php

namespace ALT\Core;

use ALT\Managers\Players;
use ALT\Helpers\Utils;
use ALT\Helpers\Collection;
use ALT\Core\Globals;

class Notifications
{
  protected static $listeners = [
    [
      'name' => 'biomes',
      'method' => ['ALT\Managers\Players', 'getBiomeTotals'],
    ],
    [
      'name' => 'movements',
      'method' => ['ALT\Managers\Players', 'computeStorm'],
    ],
    [
      'name' => 'blockedExpeditions',
      'method' => ['ALT\Managers\Players', 'getBlockedExpeditions'],
    ],
    [
      'name' => 'powersBlockedExpeditions',
      'method' => ['ALT\Managers\Players', 'getPowersBlockedExpeditions'],
    ],
    [
      'name' => 'defenders',
      'method' => ['ALT\Managers\Players', 'getDefenders'],
    ],
    [
      'name' => 'reserveSlots',
      'method' => ['ALT\Managers\Players', 'getReserveSlots']
    ],
    [
      'name' => 'landmarkSlots',
      'method' => ['ALT\Managers\Players', 'getLandmarkSlots']
    ]
  ];

  protected static $cachedValues = [];
  public static function resetCache()
  {
    foreach (self::$listeners as $listener) {
      $method = $listener['method'];
      self::$cachedValues[$listener['name']] = call_user_func($method);
    }
  }

  public static function updateIfNeeded()
  {
    $toSend = [];
    foreach (self::$listeners as $listener) {
      $name = $listener['name'];
      $method = $listener['method'];
      $val = call_user_func($method);
      if ($val !== (self::$cachedValues[$name] ?? 'toto')) {
        self::$cachedValues[$name] = $val;
        $toSend[$name] = $val;
      }
    }

    if (!empty($toSend)) {
      Game::get()->notifyAllPlayers('updateInformations', '', $toSend);
    }
  }

  /*************************
   **** GENERIC METHODS ****
   *************************/
  protected static function notifyAll($name, $msg, $data)
  {
    self::updateArgs($data);
    Game::get()->notifyAllPlayers($name, $msg, $data);
    self::updateIfNeeded();
  }

  protected static function notify($player, $name, $msg, $data)
  {
    $pId = is_int($player) ? $player : $player->getId();
    self::updateArgs($data);
    Game::get()->notifyPlayer($pId, $name, $msg, $data);
  }

  public static function message($txt, $args = [])
  {
    self::notifyAll('mediumMessage', $txt, $args);
  }

  public static function messageTo($player, $txt, $args = [])
  {
    $pId = is_int($player) ? $player : $player->getId();
    self::notify($pId, 'mediumMessage', $txt, $args);
  }

  public static function newUndoableStep($player, $stepId)
  {
    self::notify($player, 'newUndoableStep', clienttranslate('Undo here'), [
      'stepId' => $stepId,
      'preserve' => ['stepId'],
    ]);
  }

  public static function clearTurn($player, $notifIds, $silent = false)
  {
    $msg = clienttranslate('${player_name} restarts their turn');
    if ($silent === true) {
      $msg = '';
    }
    self::notifyAll('clearTurn', $msg, [
      'player' => $player,
      'notifIds' => $notifIds,
    ]);
  }

  ///////////////////////////////////////////////////////////
  //  ____       _           _     ____            _
  // / ___|  ___| | ___  ___| |_  |  _ \  ___  ___| | __
  // \___ \ / _ \ |/ _ \/ __| __| | | | |/ _ \/ __| |/ /
  //  ___) |  __/ |  __/ (__| |_  | |_| |  __/ (__|   <
  // |____/ \___|_|\___|\___|\__| |____/ \___|\___|_|\_\
  ///////////////////////////////////////////////////////////

  public static function updateInitialPrecoDeckSelection($player, $args)
  {
    self::notify($player, 'updateInitialPrecoDeckSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function updateDeckList($player, $deckList)
  {
    self::notify($player, 'updateDeckList', '', ['deckList' => $deckList]);
  }

  public static function vsScreen($factions)
  {
    self::notifyAll('vsScreen', '', ['factions' => $factions]);
  }

  public static function setupDeck($player, $meeples, $hero)
  {
    $factionNames = [
      \FACTION_BR => clienttranslate('Bravos'),
      \FACTION_MU => clienttranslate('Muna'),
      \FACTION_OD => clienttranslate('Ordis'),
      \FACTION_AX => clienttranslate('Axiom'),
      \FACTION_LY => clienttranslate('Lyra'),
      \FACTION_YZ => clienttranslate('Yzmir'),
    ];

    self::notifyAll(
      'setupPlayer',
      clienttranslate('${player_name} will play the faction ${faction_name} with the hero ${card_name}'),
      [
        'player' => $player,
        'i18n' => ['faction_name'],
        'faction_name' => $factionNames[$player->getFaction()],
        'faction' => $player->getFaction(),
        'meeples' => $meeples->toArray(),
        'card' => $hero,
        'deckCount' => $player->getDeckCount(),
      ]
    );
  }

  // public static function setupCards($cards)
  // {
  //   self::notifyAll('setupCards', '', ['cardsTo' => $cards]);
  // }

  /////////////////////////////////////////////////
  //  _   _                 ____
  // | \ | | _____      __ |  _ \  __ _ _   _
  // |  \| |/ _ \ \ /\ / / | | | |/ _` | | | |
  // | |\  |  __/\ V  V /  | |_| | (_| | |_| |
  // |_| \_|\___| \_/\_/   |____/ \__,_|\__, |
  //                                    |___/
  /////////////////////////////////////////////////

  public static function updateFirstDayManaSelection($player, $args)
  {
    self::notify($player, 'updateFirstDayManaSelection', '', [
      'args' => ['canPass' => $args['canPass'], '_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function discardMana($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $privateArgs = null)
  {
    self::discardCards(
      $player,
      $cards,
      $privateMsg ?? clienttranslate('You place ${card_names} as mana'),
      $publicMsg ?? clienttranslate('${player_name} places ${n} card(s) as mana'),
      array_merge(['toMana' => true], $args),
      $privateArgs
    );
  }

  public static function newFirstPlayer($firstPlayer)
  {
    self::notifyAll('newFirstPlayer', clienttranslate('${player_name} becomes First player'), [
      'player' => $firstPlayer,
    ]);
  }

  public static function switchPlayer($firstPlayer)
  {
    self::notifyAll('switchPlayer', clienttranslate('${player_name} becomes First player'), [
      'player' => $firstPlayer,
    ]);
  }

  public static function setTerrainMarker($player, $marker, $source)
  {
    self::notifyAll('slideMeeples', clienttranslate('${player_name} places a ${biome_icon}${biome_name} terrain marker on a region (${card_name}\'s effect)'), [
      'player' => $player,
      'meeples' => [$marker],
      'biome_name' => $marker->getType(),
      'biome_icon' => '',
      'card' => $source
    ]);
  }

  public static function addTerrainMarkers($markers)
  {
    self::notifyAll('slideMeeples', '', [
      'meeples' => $markers->toArray(),
    ]);
  }

  public static function moveTerrainMarker($player, $marker, $source)
  {
    self::notifyAll('slideMeeples', clienttranslate('${player_name} moves a ${biome_icon}${biome_name} terrain marker on a region (${card_name}\'s effect)'), [
      'player' => $player,
      'meeples' => [$marker],
      'biome_name' => $marker->getType(),
      'biome_icon' => '',
      'card' => $source
    ]);
  }

  //////////////////////////////////////////////////////
  //  ____            _      _   _ _       _     _
  // |  _ \ _   _ ___| | __ | \ | (_) __ _| |__ | |_
  // | | | | | | / __| |/ / |  \| | |/ _` | '_ \| __|
  // | |_| | |_| \__ \   <  | |\  | | (_| | | | | |_
  // |____/ \__,_|___/_|\_\ |_| \_|_|\__, |_| |_|\__|
  //                                 |___/
  //////////////////////////////////////////////////////
  public static function startDusk()
  {
    self::notifyAll('startDusk', clienttranslate('Computing the progress in the Tumult'), []);
  }

  public static function endDusk()
  {
    self::notifyAll('endDusk', '', []);
  }

  public static function moveStormToken($player, $biomes, $tokenMeeple, $stormIndex, $revealed, $source)
  {
    $msg = clienttranslate('${player_name} advances in ${expedition} expedition by winning in ${biomes_desc}');
    if (!is_null($source)) {
      $msg = clienttranslate('${player_name} moves in ${expedition} due to ${card_name}\'s effect');
    }

    self::notifyAll('moveStormToken', $msg, [
      'i18n' => ['biome', 'expedition'],
      'player' => $player,
      'biomes_desc' => $biomes,
      'expedition' => $tokenMeeple->getType(),
      'token' => $tokenMeeple,
      'stormIndex' => $stormIndex,
      'revealed' => $revealed,
      'card' => $source,
    ]);
  }

  public static function cleanupCards($player, $cards)
  {
    $msg = clienttranslate('All remaining cards of ${player_name} loose Anchored and Asleep');
    self::notifyAll('cleanupCards', $msg, ['player' => $player, 'cardIds' => $cards]);
  }

  public static function nightCleanup($player, $deletedCards, $deletedMeepleIds, $movedToReserve, $deletedCardTokens)
  {
    $msg = clienttranslate('${player_name} discards ${card_names} and moves ${card_names2} to reserve');
    if ($deletedCards->empty()) {
      if ($movedToReserve->empty()) {
        $msg = '';
      } else {
        $msg = clienttranslate('${player_name} moves ${card_names2} to reserve');
      }
    } elseif ($movedToReserve->empty()) {
      $msg = clienttranslate('${player_name} discards ${card_names}');
    }

    self::notifyAll('nightCleanup', $msg, [
      'player' => $player,
      'cards' => $deletedCards->toArray(),
      'cards2' => $movedToReserve->toArray(),
      'cards3' => $deletedCardTokens->toArray(),
      'meeples' => $deletedMeepleIds,
    ]);
  }

  public static function untap($cardIds)
  {
    self::notifyAll('untap', '', ['cardIds' => $cardIds]);
  }

  public static function updateTotalMana()
  {
    self::notifyAll('updateTotalMana', '', [
      'manas' => Players::getAll()->reduce(function ($mana, $player) {
        $mana[$player->getId()] = $player->getTotalMana();
        return $mana;
      }, []),
    ]);
  }

  public static function updateNightSelection($player, $args)
  {
    self::notify($player, 'updateNightSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function moveCard($player, $card, $source)
  {
    self::notifyAll(
      'moveCard',
      clienttranslate('${player_name} moves ${card_name} to opposite expedition (${card_name2}\'s effect)'),
      ['player' => $player, 'card' => $card, 'card2' => $source]
    );
  }

  public static function defect($card, $player, $source)
  {
    self::notifyAll(
      'moveCard',
      clienttranslate('${card_name} defects to ${player_name}\'s side(${card_name2}\'s effect)'),
      ['player' => $player, 'card' => $card, 'card2' => $source]
    );
  }

  /////////////////////////////////
  //    ____              _
  //   / ___|__ _ _ __ __| |___
  //  | |   / _` | '__/ _` / __|
  //  | |__| (_| | | | (_| \__ \
  //   \____\__,_|_|  \__,_|___/
  /////////////////////////////////

  public static function discardCards($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $privateArgs = null)
  {
    self::notifyAll(
      'discardCards',
      $publicMsg ?? clienttranslate('${player_name} discards ${n} card(s)'),
      $args + [
        'player' => $player,
        'n' => count($cards),
        'mana' => $player->getMana(),
      ]
    );
    self::notify(
      $player,
      'pDiscardCards',
      $privateMsg ?? clienttranslate('You discard ${card_names}'),
      ($privateArgs ?? $args) + [
        'player' => $player,
        'cards' => $cards->toArray(),
      ]
    );
  }

  public static function publicDiscard($player, $cards, $publicMsg = null, $args = [])
  {
    self::notifyAll(
      'publicDiscard',
      $publicMsg ?? clienttranslate('${player_name} discards ${card_names} (${n} card(s))'),
      $args + [
        'player' => $player,
        'n' => count($cards),
        'cards' => $cards->toArray(),
        'totalMana' => $player->getTotalMana(),
        'mana' => $player->getMana(),
      ]
    );
  }

  public static function publicDiscardToMana($player, $cards, $publicMsg = null, $args = [])
  {
    self::notifyAll(
      'publicDiscard',
      $publicMsg ?? clienttranslate('${player_name} discards ${card_names} to mana'),
      $args + [
        'player' => $player,
        'n' => count($cards),
        'cards' => $cards->toArray(),
        'totalMana' => $player->getTotalMana(),
        'mana' => $player->getMana(),
        'toMana' => true,
      ]
    );
  }

  public static function putOnDeck($player, $cards, $args = [])
  {
    $msg = clienttranslate('${player_name} puts ${card_names} on top of its deck');

    if (isset($args['tokensOnly']) && $args['tokensOnly'] == true) {
      // if we put on deck a token, it's destroyed
      $msg = clienttranslate('${player_name} remove ${card_names} from play');
    }

    self::notifyAll(
      'putOnDeck',
      $msg,
      $args + [
        'player' => $player,
        'n' => count($cards),
        'cards' => $cards->toArray(),
        'totalMana' => $player->getTotalMana(),
        'mana' => $player->getMana(),
      ]
    );
  }

  public static function moveToHand($player, $cards, $publicMsg = null, $privateMsg = null, $args = [], $privateArgs = null)
  {
    self::notifyAll(
      'moveToHand',
      $publicMsg ?? clienttranslate('${player_name} places ${n} card(s) in his hand'),
      $args + [
        'player' => $player,
        'cards' => $cards->toArray(),
        'n' => count($cards),
      ]
    );
  }

  public static function drawCards($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $public = false)
  {
    if ($public === true) {
      self::notifyAll(
        'publicDrawCards',
        $publicMsg ?? clienttranslate('${player_name} draws ${card_names} from his deck'),
        $args + [
          'player' => $player,
          'cards' => is_array($cards) ? $cards : $cards->toArray(),
          'n' => count($cards),
        ]
      );
      return;
    }
    self::notifyAll(
      'drawCards',
      $publicMsg ?? clienttranslate('${player_name} draws ${n} card(s) from its deck'),
      $args + [
        'player' => $player,
        'n' => count($cards),
      ]
    );
    self::notify(
      $player,
      'pDrawCards',
      $privateMsg ?? clienttranslate('You draw ${card_names} from your deck'),
      $args + [
        'player' => $player,
        'cards' => is_array($cards) ? $cards : $cards->toArray(),
      ]
    );
  }

  /////////////////////////////////////////
  //     _        _   _
  //    / \   ___| |_(_) ___  _ __  ___
  //   / _ \ / __| __| |/ _ \| '_ \/ __|
  //  / ___ \ (__| |_| | (_) | | | \__ \
  // /_/   \_\___|\__|_|\___/|_| |_|___/
  /////////////////////////////////////////

  public static function playCard($player, $card, $cost, $fromLocation, $location, $meeples = [])
  {
    $msg = '';
    if ($location == 'limbo') {
      $msg =
        $fromLocation == RESERVE
        ? clienttranslate('${player_name} plays ${card_name} from Reserve for ${mana_cost}')
        : clienttranslate('${player_name} plays ${card_name} for ${mana_cost}');
    } else {
      $msg =
        $fromLocation == RESERVE
        ? clienttranslate('${player_name} plays ${card_name} from Reserve for ${mana_cost} and places it in ${displayLocation}')
        : clienttranslate('${player_name} plays ${card_name} for ${mana_cost} and places it in ${displayLocation}');
    }

    if (!empty($meeples)) {
      self::silentKill($meeples);
    }

    self::notifyAll('playCard', $msg, [
      'player' => $player,
      'card' => $card,
      'mana_cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'biomes' => $player->getBiomeStrength(),
      'movements' => Players::computeStorm(),
      'location' => $location,
      'fromLocation' => $fromLocation,
      'displayLocation' => $location,
      'i18n' => ['displayLocation'],
    ]);
  }

  public static function afterYou($player, $cost, $source)
  {
    if ($cost != 0) {
      $msg = clienttranslate('${player_name} triggers After You effect and pays ${mana_cost} (${card_name}\'s effect)');
    } else {
      $msg = clienttranslate('${player_name} triggers After You effect (${card_name}\'s effect)');
    }
    self::notifyAll('afterYou', $msg, [
      'player' => $player,
      'mana_cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'card' => $source,
    ]);
  }

  public static function roll($player, $rolls, $source)
  {
    self::notifyAll('roll', clienttranslate('${player_name} rolls ${roll_text} (${card_name2}\'s effect)'), [
      'player' => $player,
      'rolls' => $rolls,
      'roll_text' => implode(', ', $rolls),
      'card2' => $source,
    ]);
  }

  public static function winTieBreaker($player, $n)
  {
    self::notifyAll('winTieBreaker', clienttranslate('${player_name} wins the tiebreaker with ${n} attributes'), [
      'player' => $player,
      'n' => $n,
    ]);
  }

  public static function startTiebreak($meeples)
  {
    self::notifyAll(
      'startTiebreak',
      clienttranslate('The tiebreaker is triggered as heroes reached their companions at the same time'),
      ['meeples' => $meeples]
    );
  }

  public static function newPhase($phase)
  {
    // decide phase
    $msgs = [
      PHASE_MORNING => clienttranslate('${phase_icon} Day n°${day}: morning ${phase_icon2}'),
      PHASE_NOON => clienttranslate('${phase_icon} Day n°${day}: noon ${phase_icon2}'),
      PHASE_AFTERNOON => clienttranslate('${phase_icon} Day n°${day}: afternoon ${phase_icon2}'),
      PHASE_DUSK => clienttranslate('${phase_icon} Day n°${day}: dusk ${phase_icon2}'),
      PHASE_NIGHT => clienttranslate('${phase_icon} Day n°${day}: night ${phase_icon2}'),
    ];
    $msg = $msgs[$phase];
    self::notifyAll('newPhase', $msg, [
      'phase' => $phase,
      'day' => Globals::getDay(),
      'phase_icon' => '',
      'phase_icon2' => '',
      'preserve' => ['phase_icon', 'phase_icon2'],
      'phaseId' => Globals::getPhase(),
    ]);
  }

  public static function gainCounter($card, $increase = null)
  {
    self::notifyAll('gainCounter', clienttranslate('${card_name} gains ${increase} ${counterName}'), [
      'card' => $card,
      'value' => $card->getExtraDatas()['counter'],
      'increase' => is_null($increase) ? $card->getExtraDatas()['counter'] : $increase,
      'counterName' => $card->getExtraDatas()['counterName'],
      'i18n' => ['counterName'],
    ]);
  }

  public static function useCounter($player, $card, $consume, $cost, $source)
  {
    if ($cost > 0) {
      $msg = clienttranslate('${player_name} pays ${mana_cost} and reduce by ${consume} the counter (${card_name}\'s effect)');
    } else {
      $msg = clienttranslate('${player_name} reduce by ${consume} the counter (${card_name}\'s effect)');
    }
    self::notifyAll('useCounter', $msg, [
      'player' => $player,
      'mana_cost' => $cost,
      'consume' => $consume,
      'card' => $source,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'value' => $card->getExtraDatas()['counter'],
      'decrease' => $consume,
    ]);
  }

  public static function deleteCounter($card)
  {
    self::notifyAll('deleteCounter', '', [
      'card' => $card,
    ]);
  }

  public static function gainMeeple($power, $card, $meeples, $source = null, $silent = true)
  {
    $n = count($meeples);
    $msg = '';
    if (!$silent) {
      if (!is_null($source)) {
        $msg =
          $n == 1
          ? clienttranslate('${card_name} gains ${power} (${card_name2}\'s effect)')
          : clienttranslate('${card_name} gains ${n} ${power} (${card_name2}\'s effect)');
      } else {
        $msg = $n == 1 ? clienttranslate('${card_name} gains ${power}') : clienttranslate('${card_name} gains ${n} ${power}');
      }
    }
    self::notifyAll('addMeeples', $msg, [
      'card' => $card,
      'power' => $power,
      'i18n' => ['power'],
      'meeples' => is_array($meeples) ? $meeples : $meeples->toArray(),
      'card2' => $source,
      'n' => $n,
    ]);
  }

  public static function ascend($meeple, $player, $source, $expedition)
  {
    $msg = $expedition == STORM_LEFT ? clienttranslate('${player_name}\'s Hero expedition ascends (${card_name2}\'s effect)') : clienttranslate('${player_name}\'s Companion expedition ascends (${card_name2}\'s effect)');
    self::notifyAll('addMeeples', $msg, [
      'player' => $player,
      'meeples' => [$meeple],
      'card2' => $source,
    ]);
  }

  public static function targetCards($player, $cards, $additionalCost, $source)
  {
    if ($additionalCost > 0) {
      $msg = clienttranslate('${player_name} targets ${card_names} for ${card_name}\'s effect and pays ${n} (Tough effect)');
    } elseif (!is_null($source)) {
      $msg = clienttranslate('${player_name} targets ${card_names} for ${card_name}\'s effect');
    } else {
      $msg = clienttranslate('${player_name} targets ${card_names}');
    }
    self::notifyAll('targetCards', $msg, [
      'player' => $player,
      'cards' => $cards,
      'card' => $source,
      'n' => $additionalCost,
      'mana' => $player->getMana(),
    ]);
  }

  public static function looseMeeples($power, $card, $meeples, $silent = true)
  {
    $msg = '';
    if (!$silent) {
      $msg = clienttranslate('${card_name} loses ${n} ${power}');
    }
    self::notifyAll('looseMeeples', $msg, [
      'card' => $card,
      'power' => $power,
      'i18n' => ['power'],
      'meeples' => $meeples->toArray(),
      'n' => count($meeples),
    ]);
  }

  public static function supportEffect($player, $card)
  {
    self::notifyAll('supportEffect', clienttranslate('${player_name} activates support effect of ${card_name} and discards it'), [
      'player' => $player,
      'card' => $card,
    ]);
  }

  public static function tapEffect($player, $card, $cost = 0)
  {
    if ($cost > 0) {
      $msg = clienttranslate('${player_name} pays ${mana_cost} and taps ${card_name} to activate it\'s effect');
    } else {
      $msg = clienttranslate('${player_name} taps ${card_name} to activate it\'s effect');
    }

    self::notifyAll('tap', $msg, [
      'player' => $player,
      'card' => $card,
      'mana_cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function exhaustEffect($player, $card, $source)
  {
    self::notifyAll('tap', clienttranslate('${player_name} exhaust ${card_name} (${card_name2}\'s effect)'), [
      'player' => $player,
      'card' => $card,
      'card2' => $source,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function readyEffect($player, $card, $source)
  {
    if ($card->getLocation() == MANA) {
      // must not reveal hidden info
      self::notifyAll('publicReadyMana', clienttranslate('${player_name} ready a mana orb (${card_name2}\'s effect)'), [
        'player' => $player,
        // 'card' => $card,
        'card2' => $source,
        'mana' => $player->getMana(),
      ]);
      self::notify($player, 'privateReadyMana',  clienttranslate('${player_name} ready ${card_name} (mana orb) (${card_name2}\'s effect)'), [
        'player' => $player,
        'card' => $card,
        'card2' => $source,
        'totalMana' => $player->getTotalMana(),
        'mana' => $player->getMana(),
      ]);
    } else {
      self::notifyAll('ready', clienttranslate('${player_name} ready ${card_name} (${card_name2}\'s effect)'), [
        'player' => $player,
        'card' => $card,
        'card2' => $source,
        // 'totalMana' => $player->getTotalMana(),
        // 'mana' => $player->getMana(),
      ]);
    }
  }

  /////////:********************* BISE ************************//
  public static function spend($power, $card, $meeples, $silent = true)
  {
    $msg = '';
    if (!$silent) {
      $msg = clienttranslate('${card_name} spends ${n} ${power}');
    }
    self::notifyAll('looseMeeples', $msg, [
      'card' => $card,
      'power' => $power,
      'i18n' => ['power'],
      'meeples' => $meeples->toArray(),
      'n' => count($meeples),
    ]);
  }

  public static function spendCounter($player, $card, $consume, $source)
  {
    $msg = clienttranslate('${player_name} reduce by ${consume} the counter (${card_name}\'s effect)');

    self::notifyAll('useCounter', $msg, [
      'player' => $player,
      'consume' => $consume,
      'card' => $card,
      'value' => $card->getExtraDatas()['counter'],
      'decrease' => $consume,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function pay($player, $cost)
  {
    self::notifyAll('pay', clienttranslate('${player_name} pays ${mana_cost}'), [
      'player' => $player,
      'mana_cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function reveal($toReveal, $source)
  {

    self::notifyAll(
      'publicDrawCards',
      clienttranslate('${player_name} reveals ${card_names} (${card_name2}\'s effect)'),
      [
        'player' => $toReveal->getPlayer(),
        'cards' => [$toReveal],
        'card2' => $source
      ]
    );

    // self::notifyAll('revealCard',  [
    //   'player' => $toReveal->getPlayer(),
    //   'card' => $toReveal,
    //   'card2' => $source
    // ]);
  }

  public static function revealHand($toReveal, $source)
  {

    self::notifyAll(
      'revealHand',
      clienttranslate('${player_name} reveals ${card_name} (${card_name2}\'s effect)'),
      [
        'player' => $toReveal->getPlayer(),
        'card' => $toReveal,
        'card2' => $source
      ]
    );
  }

  public static function endReveal($revealed, $player)
  {
    self::notifyAll(
      'endReveal',
      '',
      [
        'player_id' => $player->getId(),
        'cardsRevealed' => $revealed
      ]
    );
  }

  public static function pass($player)
  {
    self::notifyAll('passTurn', clienttranslate('${player_name} passes and ends its afternoon'), ['player' => $player]);
  }

  public static function shuffleDeck($player, $location, $nCards)
  {
    self::notifyAll('shuffleDeck', clienttranslate('${player_name} exhauts its deck and shuffle the discard'), [
      'player' => $player,
      'location' => $location,
      'n' => $nCards,
    ]);
  }

  public static function spellCleanup($card, $deleted)
  {
    self::notifyAll('spellCleanup', ' ', ['card' => $card, 'deleted' => $deleted]);
  }

  public static function invokeToken($player, $card, $source)
  {
    self::notifyAll(
      'invokeToken',
      clienttranslate('${player_name} invokes ${card_name} in ${displayLocation} (${card_name2}\'s effect)'),
      [
        'player' => $player,
        'location' => $card->getLocation(),
        'displayLocation' => $card->getLocation(),
        'card' => $card,
        'card2' => $source,
        'i18n' => ['token_type'],
      ]
    );
  }

  /*** tools****/
  public static function silentKill($tokens, $cards = [])
  {
    self::notifyAll('silentKill', '', [
      'tokens' => is_array($tokens) ? $tokens : $tokens->toArray(),
      'cardsDeleted' => is_array($cards) ? $cards : $cards->toArray(),
    ]);
  }

  public static function blockExpedition($player, $blockedPlayer, $expedition)
  {
    self::notifyAll(
      'mediumMessage',
      clienttranslate('${player_name} blocks ${player_name2} ${expedition}\'s expedition until next Day'),
      [
        'player' => $player,
        'player2' => $blockedPlayer,
        'expedition' => $expedition == STORM_LEFT ? clienttranslate('Hero') : clienttranslate('Companion'),
      ]
    );
  }

  public static function blockAllExpeditions($player, $source)
  {
    self::notifyAll('mediumMessage', clienttranslate('${player_name} blocks all expeditions until next Day (${card_name}'), [
      'player' => $player,
      'card' => $source,
    ]);
  }

  /*********** unchecked ******* */
  public static function refreshUI($datas)
  {
    // // Keep only the thing that matters
    $fDatas = [
      'players' => $datas['players'],
      'cards' => $datas['cards'],
      'meeples' => $datas['meeples'],
      'passedPlayers' => $datas['passedPlayers'],
    ];
    foreach ($fDatas['players'] as &$player) {
      $player['hand'] = []; // Hide hand !
      $player['manaCards'] = []; // Hide mana
    }

    self::notifyAll('refreshUI', '', [
      'datas' => $fDatas,
    ]);
  }

  public static function refreshHand($player, $hand, $mana)
  {
    self::notify($player, 'refreshHand', '', [
      'player' => $player,
      'hand' => $hand,
      'mana' => $mana,
    ]);
  }

  public static function refreshCard($card)
  {
    self::notifyAll('refreshCard', '', ['card' => $card]);
  }

  /////////////////////////////////
  //  ____       _
  // / ___|  ___| |_ _   _ _ __
  // \___ \ / _ \ __| | | | '_ \
  //  ___) |  __/ |_| |_| | |_) |
  // |____/ \___|\__|\__,_| .__/
  //                      |_|
  /////////////////////////////////

  public static function updateInitialSelection($player, $args)
  {
    self::notify($player, 'updateInitialSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  ////////////////////////////////
  //    ____              _
  //   / ___|__ _ _ __ __| |___
  //  | |   / _` | '__/ _` / __|
  //  | |__| (_| | | | (_| \__ \
  //   \____\__,_|_|  \__,_|___/
  ////////////////////////////////

  public static function initialDraw($player, $cards, $scoringCards)
  {
    self::drawCards($player, $cards);
    self::drawCards(
      $player,
      $scoringCards,
      clienttranslate('You draw ${card_names} from the deck (scoring cards)'),
      clienttranslate('${player_name} draws ${n} scoring cards from the deck'),
      [
        'scoringCard' => true,
      ]
    );
  }

  ///////////////////////////////////////////////////////////////
  //  _   _           _       _            _
  // | | | |_ __   __| | __ _| |_ ___     / \   _ __ __ _ ___
  // | | | | '_ \ / _` |/ _` | __/ _ \   / _ \ | '__/ _` / __|
  // | |_| | |_) | (_| | (_| | ||  __/  / ___ \| | | (_| \__ \
  //  \___/| .__/ \__,_|\__,_|\__\___| /_/   \_\_|  \__, |___/
  //       |_|                                      |___/
  ///////////////////////////////////////////////////////////////

  /*
   * Automatically adds some standard field about player and/or card
   */
  protected static function updateArgs(&$data)
  {
    if (isset($data['player'])) {
      $data['player_name'] = $data['player']->getName();
      $data['player_id'] = $data['player']->getId();
      unset($data['player']);
    }
    if (isset($data['player2'])) {
      $data['player_name2'] = $data['player2']->getName();
      $data['player_id2'] = $data['player2']->getId();
      unset($data['player2']);
    }
    if (isset($data['player3'])) {
      $data['player_name3'] = $data['player3']->getName();
      $data['player_id3'] = $data['player3']->getId();
      unset($data['player3']);
    }
    if (isset($data['players'])) {
      $args = [];
      $logs = [];
      foreach ($data['players'] as $i => $player) {
        $logs[] = '${player_name' . $i . '}';
        $args['player_name' . $i] = $player->getName();
      }
      $data['players_names'] = [
        'log' => join(', ', $logs),
        'args' => $args,
      ];
      $data['i18n'][] = 'players_names';
      unset($data['players']);
    }

    if (isset($data['displayLocation'])) {
      $data['displayLocation'] =
        $data['displayLocation'] == STORM_LEFT
        ? clienttranslate('Hero\'s expedition')
        : ($data['displayLocation'] == LANDMARK ? clienttranslate('Landmark\'s zone') : clienttranslate('Companion\'s expedition'));
    }

    if (isset($data['card'])) {
      $data['card_id'] = $data['card']->getId();
      $data['card_name'] = $data['card']->getName();
      $data['i18n'][] = 'card_name';
      $data['preserve'][] = 'card_id';
    }

    if (isset($data['card2'])) {
      $data['card_id2'] = $data['card2']->getId();
      $data['card_name2'] = $data['card2']->getName();
      $data['i18n'][] = 'card_name2';
      $data['preserve'][] = 'card_id2';
    }

    if (isset($data['cards'])) {
      $args = [];
      $logs = [];
      foreach ($data['cards'] as $i => $card) {
        $logs[] = '${card_name_' . $i . '}';
        $args['i18n'][] = 'card_name_' . $i;
        $args['card_name_' . $i] = [
          'log' => '${card_name}',
          'args' => [
            'i18n' => ['card_name'],
            'card_name' => is_array($card) ? $card['name'] : $card->getName(),
            'card_id' => is_array($card) ? $card['id'] : $card->getId(),
            'preserve' => ['card_id'],
          ],
        ];
      }
      $data['card_names'] = [
        'log' => join(', ', $logs),
        'args' => $args,
      ];
      $data['i18n'][] = 'card_names';
    }

    if (isset($data['cards2'])) {
      $args = [];
      $logs = [];
      foreach ($data['cards2'] as $i => $card) {
        $logs[] = '${card_name_' . $i . '}';
        $args['i18n'][] = 'card_name_' . $i;
        $args['card_name_' . $i] = [
          'log' => '${card_name}',
          'args' => [
            'i18n' => ['card_name'],
            'card_name' => is_array($card) ? $card['name'] : $card->getName(),
            'card_id' => is_array($card) ? $card['id'] : $card->getId(),
            'preserve' => ['card_id'],
          ],
        ];
      }
      $data['card_names2'] = [
        'log' => join(', ', $logs),
        'args' => $args,
      ];
      $data['i18n'][] = 'card_names2';
    }

    foreach (['biomes_desc'] as $key) {
      if (isset($data[$key]) && !empty($data[$key])) {
        $biomeNames = [
          FOREST => clienttranslate('forest'),
          MOUNTAIN => clienttranslate('mountain'),
          OCEAN => clienttranslate('water'),
        ];

        $args = [];
        $i = 0;
        foreach ($data[$key] as $biome) {
          $args['i18n'][] = 'biome_' . $i;
          $args['biome_' . $i] = [
            'log' => '${biome_icon}${biome_name}',
            'args' => [
              'i18n' => ['biome_name'],
              'biome_name' => $biomeNames[$biome],
              'biome_icon' => '',
            ],
          ];
          $i++;
        }
        $logs = [
          1 => '${biome_0}',
          2 => clienttranslate('${biome_0} and ${biome_1}'),
          3 => clienttranslate('${biome_0}, ${biome_1} and ${biome_2}'),
        ];
        $data[$key] = [
          'log' => $logs[$i],
          'args' => $args,
        ];
        $data['i18n'][] = $key . '_desc';
      }
    }

    self::jsonSerialize($data);
  }

  public static function jsonSerialize(&$args)
  {
    foreach ($args as &$value) {
      if (is_object($value)) {
        $value = $value->jsonSerialize();
      } elseif (is_array($value)) {
        self::jsonSerialize($value);
      }
    }
  }
}

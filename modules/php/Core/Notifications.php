<?php

namespace ALT\Core;

use ALT\Managers\Players;
use ALT\Helpers\Utils;
use ALT\Helpers\Collection;
use ALT\Core\Globals;

class Notifications
{
  /*************************
   **** GENERIC METHODS ****
   *************************/
  protected static function notifyAll($name, $msg, $data)
  {
    self::updateArgs($data);
    Game::get()->notifyAllPlayers($name, $msg, $data);
  }

  protected static function notify($player, $name, $msg, $data)
  {
    $pId = is_int($player) ? $player : $player->getId();
    self::updateArgs($data);
    Game::get()->notifyPlayer($pId, $name, $msg, $data);
  }

  public static function message($txt, $args = [])
  {
    self::notifyAll('message', $txt, $args);
  }

  public static function messageTo($player, $txt, $args = [])
  {
    $pId = is_int($player) ? $player : $player->getId();
    self::notify($pId, 'message', $txt, $args);
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
    self::notifyAll('startDusk', clienttranslate('End of the day: computing the progress on the storms'), []);
  }

  public static function endDusk()
  {
    self::notifyAll('endDusk', clienttranslate('Dusk phase is over, starting night phase'), []);
  }

  public static function moveStormToken($player, $biome, $tokenMeeple, $stormIndex, $revealed, $source)
  {
    $msg = clienttranslate('${player_name} advances in ${expedition} expedition by winning in ${biome}');
    if (!is_null($source)) {
      $msg = clienttranslate('${player_name} moves in ${expedition} due to ${card_name}\'s effect');
    }

    self::notifyAll('moveStormToken', $msg, [
      'i18n' => ['biome', 'expedition'],
      'player' => $player,
      'biome' => $biome,
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

  public static function nightCleanup($player, $deletedCards, $deletedTokens, $movedToReserve, $deletedCardTokens)
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
      'meeples' => $deletedTokens,
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

  public static function payMana($player, $amount, $total, $cardIds, $source)
  {
    if ($source === null) {
      $msg = clienttranslate('${player_name} pays ${amount} mana');
    } else {
      $msg = clienttranslate('${player_name} pays ${amount} mana for ${source}');
    }

    self::notifyAll('payMana', $msg, [
      'i18n' => ['source'],
      'player' => $player,
      'source' => $source,
      'amount' => $amount,
      'total' => $total,
      'cardIds' => $cardIds,
    ]);
  }

  public static function playCard($player, $card, $cost, $fromLocation, $location)
  {
    $msg = '';
    if ($location == 'limbo') {
      $msg =
        $fromLocation == RESERVE
          ? clienttranslate('${player_name} plays ${card_name} from Reserve for ${cost}')
          : clienttranslate('${player_name} plays ${card_name} for ${cost}');
    } else {
      $msg =
        $fromLocation == RESERVE
          ? clienttranslate('${player_name} plays ${card_name} from Reserve for ${cost} and places it in ${displayLocation}')
          : clienttranslate('${player_name} plays ${card_name} for ${cost} and places it in ${displayLocation}');
    }

    self::notifyAll('playCard', $msg, [
      'player' => $player,
      'card' => $card,
      'cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'biomes' => $player->getBiomeStrength(),
      'movements' => Players::computeStorm(),
      'location' => $location,
      'fromLocation' => $fromLocation,
      'displayLocation' => $location,
      'i18n' => ['location', 'fromLocation', 'displayLocation'],
    ]);
  }

  public static function afterYou($player, $cost, $source)
  {
    if ($cost != 0) {
      $msg = clienttranslate('${player_name} triggers After You effect and pays ${cost} (${card_name}\'s effect)');
    } else {
      $msg = clienttranslate('${player_name} triggers After You effect (${card_name}\'s effect)');
    }
    self::notifyAll('afterYou', $msg, [
      'player' => $player,
      'cost' => $cost,
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

  public static function updateBiomes($player)
  {
    self::notifyAll('updateBiomes', '', [
      'biomes' => $player->getBiomeStrength(),
      'pId' => $player->getId(),
      'movements' => Players::computeStorm(),
    ]);
  }

  public static function winTieBreaker($player, $n)
  {
    self::notifyAll('winTieBreaker', clienttranslate('${player_name} wins the tiebreaker with ${n} attributes'), [
      'player' => $player,
      'n' => $n,
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
      $msg = clienttranslate('${player_name} pays {${n}} and reduce by ${consume} the counter (${card_name}\'s effect)');
    } else {
      $msg = clienttranslate('${player_name} reduce by ${consume} the counter (${card_name}\'s effect)');
    }
    self::notifyAll('useCounter', $msg, [
      'player' => $player,
      'n' => $cost,
      'consume' => $consume,
      'card' => $source,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'value' => $card->getExtraDatas()['counter'],
      'decrease' => $consume,
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

  public static function targetCards($player, $cards, $additionalCost, $source)
  {
    if ($additionalCost > 0) {
      $msg = clienttranslate('${player_name} targets ${card_names} for ${card_name}\'s effect and pays {${n}} (Tough effect)');
    } else {
      $msg = clienttranslate('${player_name} targets ${card_names} for ${card_name}\'s effect');
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
      $msg = clienttranslate('${card_name} looses ${n} ${power}');
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
      $msg = clienttranslate('${player_name} pays {${cost}} and taps ${card_name} to activate it\'s effect');
    } else {
      $msg = clienttranslate('${player_name} taps ${card_name} to activate it\'s effect');
    }

    self::notifyAll('tap', $msg, [
      'player' => $player,
      'card' => $card,
      'cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function pay($player, $cost)
  {
    self::notifyAll('pay', clienttranslate('${player_name} pays {${cost}}'), [
      'player' => $player,
      'cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
    ]);
  }

  public static function pass($player)
  {
    self::notifyAll('passTurn', clienttranslate('${player_name} passes and end its day'), ['player' => $player]);
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
    self::notifyAll('spellCleanup', '', ['card' => $card, 'deleted' => $deleted]);
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

  /*********** unchecked ******* */
  public static function refreshUI($datas)
  {
    // // Keep only the thing that matters
    $fDatas = [
      'players' => $datas['players'],
      'cards' => $datas['cards'],
      'meeples' => $datas['meeples'],
      'movements' => $datas['movements'],
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
          : clienttranslate('Companion\'s expedition');
    }

    // if (isset($data['actionCard'])) {
    //   $lvlMapping = [
    //     1 => 'I',
    //     2 => 'II',
    //   ];
    //   $card = $data['actionCard'];
    //   $data['i18n'][] = 'action_card_name';
    //   $data['action_card_name'] = $card->getName();
    //   $data['action_card_level'] = $lvlMapping[$card->getLevel()];
    //   $data['action_card_icon'] = '';
    //   $data['action_card_type'] = $card->getType();
    //   $data['preserve'][] = 'action_card_type';
    // }

    // if (isset($data['actionCards'])) {
    //   $data['actionCards'] = $data['actionCards']->map(function ($card) {
    //     return $card->getStrength();
    //   });
    // }

    // // Useful for frontend formating
    // if (isset($data['strength'])) {
    //   $data['strength_icon'] = '';
    // }

    // if (isset($data['building'])) {
    //   $building = $data['building'];
    //   $names = [
    //     'pavilion' => clienttranslate('a pavilion'),
    //     'kiosk' => clienttranslate('a Kiosk'),
    //     LARGE_BIRD_AVIARY => clienttranslate('the Large Bird Aviary'),
    //     PETTING_ZOO => clienttranslate('the Petting Zoo'),
    //     REPTILE_HOUSE => clienttranslate('the Reptile House'),
    //     'empty' => clienttranslate('no enclosure'),
    //   ];
    //   $name = $names[$building['type']] ?? [
    //     'log' => clienttranslate('a size-${n} enclosure'),
    //     'args' => ['n' => count(\BUILDINGS[$building['type']])],
    //   ];
    //   if (in_array($building['type'], \UNIQUE_BUILDINGS)) {
    //     $name = \clienttranslate('a unique building');
    //   }

    //   $data['i18n'][] = 'building_name';
    //   $data['building_name'] = $name;
    // }

    // if (isset($data['building2'])) {
    //   $building = $data['building2'];
    //   $names = [
    //     'pavilion' => clienttranslate('a pavilion'),
    //     'kiosk' => clienttranslate('a Kiosk'),
    //     LARGE_BIRD_AVIARY => clienttranslate('the Large Bird Aviary'),
    //     PETTING_ZOO => clienttranslate('the Petting Zoo'),
    //     REPTILE_HOUSE => clienttranslate('the Reptile House'),
    //   ];
    //   $data['i18n'][] = 'building_name2';
    //   $data['building_name2'] = $names[$building['type']] ?? [
    //     'log' => clienttranslate('a size-${n} enclosure'),
    //     'args' => ['n' => count(\BUILDINGS[$building['type']])],
    //   ];
    // }

    // if (isset($data['resources'])) {
    //   // Get an associative array $resource => $amount
    //   $resources = Utils::reduceResources($data['resources']);
    //   $data['resources_desc'] = Utils::resourcesToStr($resources);
    // }

    // if (isset($data['resources2'])) {
    //   // Get an associative array $resource => $amount
    //   $resources2 = Utils::reduceResources($data['resources2']);
    //   $data['resources2_desc'] = Utils::resourcesToStr($resources2);
    // }

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

    foreach (['bonuses', 'bonuses2'] as $key) {
      if (isset($data[$key])) {
        $bonusesNames = [
          'money' => clienttranslate('money'),
          'appeal' => clienttranslate('appeal'),
          'reputation' => clienttranslate('reputation'),
          'conservation' => clienttranslate('conservation'),
          'xtoken' => \clienttranslate('xtoken'),
        ];

        $args = [];
        $i = 0;
        foreach ($data[$key] as $type => $bonus) {
          if ($bonus == 0) {
            continue;
          }
          $args['i18n'][] = 'bonus_' . $i;
          $args['bonus_' . $i] = [
            'log' => '${bonus}${bonus_icon} ${bonus_name}',
            'args' => [
              'i18n' => ['bonus_name'],
              'bonus_name' => $bonusesNames[$type],
              'bonus_icon' => '',
              'bonus' => $bonus > 0 ? $bonus : -$bonus,
            ],
          ];
          $i++;
        }
        $logs = [
          1 => '${bonus_0}',
          2 => clienttranslate('${bonus_0} and ${bonus_1}'),
          3 => clienttranslate('${bonus_0}, ${bonus_1} and ${bonus_2}'),
        ];
        $data[$key . '_desc'] = [
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

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

  public static function clearTurn($player, $notifIds)
  {
    self::notifyAll('clearTurn', clienttranslate('${player_name} restarts their turn'), [
      'player' => $player,
      'notifIds' => $notifIds,
    ]);
  }

  public static function setupPreco($player, $meeples)
  {
    $factionNames = [
      \FACTION_BR => clienttranslate('Bravos'),
      \FACTION_MU => clienttranslate('Muna'),
    ];

    self::notifyAll(
      'setupPlayer',
      clienttranslate('${player_name} will play the faction ${faction_name} with their preco deck'),
      [
        'player' => $player,
        'i18n' => ['faction_name'],
        'faction_name' => $factionNames[$player->getFaction()],
        'meeples' => $meeples,
      ]
    );
  }

  /************* FIRST DAY ************/
  public static function updateFirstDayManaSelection($player, $args)
  {
    self::notify($player, 'updateFirstDayManaSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function discardMana($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $privateArgs = null)
  {
    // self::notifyAll(
    //   'discardMana',
    //   $publicMsg ?? clienttranslate('${player_name} places ${n} card(s) as mana'),
    //   $args + [
    //     'player' => $player,
    //     'n' => count($cards),
    //   ]
    // );
    self::notify(
      $player,
      'pDiscardMana',
      $privateMsg ?? clienttranslate('You discard ${card_names} to mana'),
      ($privateArgs ?? $args) + [
        'player' => $player,
        'cards' => $cards,
      ]
    );
  }

  public static function discard($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $privateArgs = null)
  {
    self::notifyAll(
      'discard',
      $publicMsg ?? clienttranslate('${player_name} discards ${n} card(s)'),
      $args + [
        'player' => $player,
        'n' => count($cards),
        'cards' => $cards,
      ]
    );
  }

  public static function moveToHand($player, $cards, $privateMsg = null, $publicMsg = null, $args = [], $privateArgs = null)
  {
    self::notifyAll(
      'moveToHand',
      $publicMsg ?? clienttranslate('${player_name} places ${n} card(s) in his hand'),
      $args + [
        'player' => $player,
        'n' => count($cards),
      ]
    );
    self::notify(
      $player,
      'pMoveToHand',
      $privateMsg ?? clienttranslate('You put ${card_names} in hand'),
      ($privateArgs ?? $args) + [
        'player' => $player,
        'cards' => $cards->toArray(),
      ]
    );
  }

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

  public static function playCard($player, $card, $cost, $from, $to = null)
  {
    $msg = clienttranslate('${player_name} plays ${card_name} (${from}) for ${cost} and places it in ${to}');

    self::notifyAll('playCard', $msg, [
      'player' => $player,
      'card' => $card,
      'cost' => $cost,
      'totalMana' => $player->getTotalMana(),
      'mana' => $player->getMana(),
      'from' => $from,
      'to' => $to,
    ]);
  }

  public static function gainToken($power, $card, $silent = true)
  {
    $msg = '';
    if (!$silent) {
      $msg = clienttranslate('${card_name} gains ${power}');
    }
    self::notifyAll('gainToken', $msg, ['card' => $card, 'power' => $power]);
  }

  public static function echoEffect($player, $card)
  {
    self::notifyAll('discard', clienttranslate('${player_name} activates echo effect of ${card_name} and discards it'), [
      'player' => $player,
      'card' => $card,
    ]);
  }

  public static function tapEffect($player, $card)
  {
    self::notifyAll('tap', clienttranslate('${player_name} taps ${card_name} to activate it\'s effect'), [
      'player' => $player,
      'card' => $card,
    ]);
  }

  public static function pass($player)
  {
    self::notifyAll('message', clienttranslate('${player_name} passes and end its day'), ['player' => $player]);
  }

  public static function boost($card, $source, $tokens)
  {
    self::notifyAll('boost', clienttranslate('${card_name} gains ${n} Boost from ${source}'), [
      'card' => $card,
      'tokens' => $tokens,
      'n' => count($tokens),
      'source' => $source,
    ]);
  }

  public static function moveStormToken($player, $biome, $token)
  {
    self::notifyAll(
      'moveStomToken',
      clienttranslate('${player_name} advances in ${token-type} expedition by winning in ${biome}'),
      ['player' => $player, 'biome' => $biome, 'token-type' => $token->getType(), 'token' => $token]
    );
  }

  public static function nightCleanup($player, $deleted, $movedToReserve)
  {
    self::notifyAll('nightCleanup', '', ['player' => $player, 'deleted' => $deleted, 'reserve' => $movedToReserve]);
  }

  public static function updateNightSelection($player, $args)
  {
    self::notify($player, 'updateNightSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  /*********** unchecked ******* */
  // Remove extra information from cards
  protected function filterCardDatas($card)
  {
    return [
      'id' => $card['id'],
      'location' => $card['location'],
      'pId' => $card['pId'],
    ];
  }
  public static function refreshUI($datas)
  {
    // // Keep only the thing that matters
    $fDatas = [
      'players' => $datas['players'],
      'cards' => $datas['cards'],
      'buildings' => $datas['buildings'],
      'meeples' => $datas['meeples'],
      'break' => $datas['break'],
      'conservationBonuses' => $datas['conservationBonuses'],
    ];

    foreach ($fDatas['cards'] as $i => $card) {
      $fDatas['cards'][$i] = self::filterCardDatas($card);
    }
    foreach ($fDatas['players'] as &$player) {
      $player['hand'] = []; // Hide hand !
    }

    self::notifyAll('refreshUI', '', [
      'datas' => $fDatas,
    ]);
  }

  public static function refreshHand($player, $hand)
  {
    foreach ($hand as &$card) {
      $card = self::filterCardDatas($card);
    }
    self::notify($player, 'refreshHand', '', [
      'player' => $player,
      'hand' => $hand,
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
  public static function setupPlayer($player, $mapId, $cards, $meeples, $buildings)
  {
    self::notifyAll('setupPlayer', \clienttranslate('${player_name} will play Map ${mapId}'), [
      'player' => $player,
      'mapId' => $mapId,
      'meeples' => $meeples->toArray(),
      'buildings' => $buildings,
      'action_cards' => $cards->ui(),
    ]);
  }

  public static function updateInitialSelection($player, $args)
  {
    self::notify($player, 'updateInitialSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function updateInitialMapSelection($player, $args)
  {
    self::notify($player, 'updateInitialMapSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  /////////////////////////////////
  //  ____                 _
  // | __ ) _ __ ___  __ _| | __
  // |  _ \| '__/ _ \/ _` | |/ /
  // | |_) | | |  __/ (_| |   <
  // |____/|_|  \___|\__,_|_|\_\
  /////////////////////////////////

  public static function updateBreakDiscardSelection($player, $args)
  {
    self::notify($player, 'updateBreakDiscardSelection', '', [
      'args' => ['_private' => $args['_private'][$player->getId()]],
    ]);
  }

  public static function breakCleanupTokens($tokens)
  {
    self::notifyAll('discardTokens', clienttranslate('All tokens are removed from player cards'), [
      'meeples' => $tokens,
    ]);
  }

  public function breakReturnWorkers($workers)
  {
    self::notifyAll('slideMeeples', clienttranslate('All workers go back to each player\'s reserve'), [
      'meeples' => $workers->toArray(),
    ]);
  }

  public function breakRefill($meeples)
  {
    self::notifyAll('addMeeples', clienttranslate('Replenishing partner zoos and universities'), [
      'meeples' => $meeples->toArray(),
    ]);
  }

  public function finishBreak()
  {
    self::notifyAll('finishBreak', \clienttranslate('End of the break'), []);
  }

  public static function finalScoring($player, $score, $newScore, $appeal, $conservation, $conservationScore)
  {
    self::notifyAll(
      'finalScoring',
      clienttranslate(
        '${player_name} has ${appeal}<APPEAL> and scores ${conservationScore} for having ${conservation}<CONSERVATION>. ${player_name} scores ${newScore}.'
      ),
      [
        'player' => $player,
        'score' => $score,
        'newScore' => $newScore,
        'appeal' => $appeal,
        'conservation' => $conservation,
        'conservationScore' => $conservationScore,
        'scoringHand' => $player->getScoringHand()->ui(),
      ]
    );
  }

  public static function endOfGame()
  {
    self::notifyAll('endOfGame', clienttranslate('End of game triggered'), []);
  }

  ////////////////////////////////
  //    ____              _
  //   / ___|__ _ _ __ __| |___
  //  | |   / _` | '__/ _` / __|
  //  | |__| (_| | | | (_| \__ \
  //   \____\__,_|_|  \__,_|___/
  ////////////////////////////////

  public static function drawCards($player, $cards, $privateMsg = null, $publicMsg = null, $args = [])
  {
    self::notifyAll(
      'drawCards',
      $publicMsg ?? clienttranslate('${player_name} draws ${n} card(s) from the deck'),
      $args + [
        'player' => $player,
        'n' => count($cards),
      ]
    );
    self::notify(
      $player,
      'pDrawCards',
      $privateMsg ?? clienttranslate('You draw ${card_names} from the deck'),
      $args + [
        'player' => $player,
        'cards' => is_array($cards) ? $cards : $cards->toArray(),
      ]
    );
  }

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

  public static function snapCard($player, $card)
  {
    self::notifyAll('snapCard', clienttranslate('${player_name} snaps ${card_names} from the display'), [
      'player' => $player,
      'cards' => [$card],
    ]);
  }

  public static function takeCardInRange($player, $card)
  {
    self::notifyAll('snapCard', clienttranslate('${player_name} takes ${card_names} in reputation range from the display'), [
      'player' => $player,
      'cards' => [$card],
    ]);
  }

  public static function sponsorMagnet($player, $cards)
  {
    self::notifyAll(
      'sponsorMagnet',
      clienttranslate('${player_name} takes ${card_names} from the display (Sponsor magnet effect)'),
      [
        'player' => $player,
        'cards' => $cards->toArray(),
      ]
    );
  }

  public static function fillPool($cards, $pool)
  {
    self::notifyAll('fillPool', clienttranslate('The display is replenished with ${card_names}'), [
      'cards' => $cards,
      'pool' => $pool->toArray(),
    ]);
  }

  public static function discardCardsOnDisplay($player, $cards, $msg = null)
  {
    self::notifyAll('discardCardsOnDisplay', $msg ?? clienttranslate('${player_name} discards ${card_names} from display'), [
      'player' => $player,
      'cards' => $cards->toArray(),
    ]);
  }

  public static function discardPoolCardsBreak($cards)
  {
    self::notifyAll('discardCardsOnDisplay', \clienttranslate('Removing first two cards of the display: ${card_names}'), [
      'cards' => $cards->toArray(),
    ]);
  }

  public static function discardProject($card, $tokenIds)
  {
    self::notifyAll('discardCardsOnDisplay', clienttranslate('The rightmost project card is discarded: ${card_names}'), [
      'cards' => [$card],
      'tokenIds' => $tokenIds,
    ]);
  }

  public static function moveProjects($player, $card, $cards, $fromDisplay)
  {
    self::notifyAll(
      'moveProjects',
      $fromDisplay
        ? clienttranslate('${player_name} buys a new conservation project from display: ${card_names}')
        : clienttranslate('${player_name} plays a new conservation project: ${card_names}'),
      [
        'player' => $player,
        'cards' => [$card],
        'projects' => $cards->toArray(),
        'fromDisplay' => $fromDisplay,
      ]
    );
  }

  public static function discardScoringCard($player, $card)
  {
    self::discardCards(
      $player,
      new Collection([$card]),
      clienttranslate('You discard ${card_names} (scoring card)'),
      clienttranslate('${player_name} discards 1 scoring card'),
      ['scoringCard' => true]
    );
  }

  public static function buyAnimal($player, $animal, $cost, $enclosure, $fromDisplay)
  {
    $msg = is_null($enclosure)
      ? clienttranslate('${player_name} plays ${card_name} for ${amount_money} and places it using Flocking ability')
      : clienttranslate('${player_name} plays ${card_name} for ${amount_money} and places it in ${building_name}');

    if ($fromDisplay) {
      $msg = is_null($enclosure)
        ? clienttranslate(
          '${player_name} buys ${card_name} from display for ${amount_money} and places it using Flocking ability'
        )
        : clienttranslate('${player_name} buys ${card_name} from display for ${amount_money} and places it in ${building_name}');
    }

    self::notifyAll('buyAnimal', $msg, [
      'player' => $player,
      'card' => $animal,
      'amount' => $cost,
      'amount_money' => $cost,
      'total' => $player->getMoney(),
      'building' => $enclosure,
      'icons' => $player->countCardIcons(),
      'fromDisplay' => $fromDisplay,
    ]);
  }

  public static function releaseAnimal($player, $animal, $enclosure, $bonuses)
  {
    $data = [
      'player' => $player,
      'card' => $animal,
      'building' => $enclosure,
      'bonuses' => $bonuses,
      'icons' => $player->countCardIcons(),
      'release' => true,
      'amount' => $animal->getAppeal(),
      'score' => $player->updateScore(),
    ];
    $msg = clienttranslate(
      '${player_name} releases ${card_name} into the wild and loses ${bonuses_desc} and frees ${building_name}'
    );
    if ($bonuses[APPEAL] == 0) {
      unset($data['bonuses']);
      $msg = clienttranslate('${player_name} releases ${card_name} into the wild and frees ${building_name} (no appeal lost)');
    }
    self::notifyAll('releaseAnimal', $msg, $data);
  }

  public static function moveAnimal($player, $animal, $enclosure, $freeEnclosure)
  {
    self::notifyAll(
      'moveAnimal',
      clienttranslate('${player_name} moves ${card_name} into the ${building_name} and free ${building_name2}'),
      [
        'player' => $player,
        'card' => $animal,
        'building' => $enclosure,
        'building2' => $freeEnclosure,
        'income' => $player->getMoneyIncome(),
      ]
    );
  }

  public static function playSponsor($player, $sponsor, $meeples, $fromDisplay)
  {
    self::notifyAll(
      'playSponsor',
      $fromDisplay
        ? clienttranslate('${player_name} buys ${card_name} from display')
        : clienttranslate('${player_name} plays ${card_name}'),
      [
        'player' => $player,
        'card' => $sponsor,
        'icons' => $player->countCardIcons(),
        'meeples' => $meeples,
        'fromDisplay' => $fromDisplay,
      ]
    );
  }

  ////////////////////////////////
  //   ____       _
  //  / ___| __ _(_)_ __  ___
  // | |  _ / _` | | '_ \/ __|
  // | |_| | (_| | | | | \__ \
  //  \____|\__,_|_|_| |_|___/
  ////////////////////////////////

  public static function gain($player, $args, $source = null)
  {
    self::getBonuses($player, $args, $source, []);
  }

  public static function getBonuses($player, $bonuses, $source = null, $args = [], $msg = null)
  {
    $found = false;
    foreach ($bonuses as $type => $bonus) {
      if ($bonus > 0) {
        $found = true;
        break;
      }
    }
    if (!$found) {
      return;
    }

    if (is_null($msg)) {
      $msg = clienttranslate('${player_name} gains ${bonuses_desc}');
      if (!is_null($source)) {
        if ($source instanceof \ARK\Models\ZooCard) {
          $msg = clienttranslate('${player_name} gains ${bonuses_desc} (${card_name})');
          $args['card_id'] = $source->getId();
          $args['card_name'] = $source->getName();
          $args['i18n'][] = 'card_name';
          $args['preserve'][] = 'card_id';
        } else {
          $msg = clienttranslate('${player_name} gains ${bonuses_desc} (${source})');
          $args['source'] = $source;
          $args['i18n'][] = 'source';
        }
      }
    }

    $args['player'] = $player;
    $args['score'] = $player->updateScore();
    $args['income'] = $player->getMoneyIncome();
    $args['bonuses'] = $bonuses;
    self::notifyAll('getBonuses', $msg, $args);
  }

  public static function incAppeal($player, $amount, $total, $source = null)
  {
    self::getBonuses($player, [APPEAL => $amount], $source);
  }

  public static function incReputation($player, $amount, $total, $source = null)
  {
    self::getBonuses($player, [REPUTATION => $amount], $source);
  }

  public static function incConservation($player, $amount, $total, $source = null)
  {
    self::getBonuses($player, [CONSERVATION => $amount], $source);
  }

  public static function incMoney($player, $amount, $total, $source = null)
  {
    self::getBonuses($player, [MONEY => $amount], $source);
  }

  public static function incXToken($player, $amount, $total, $source = null)
  {
    self::getBonuses($player, [XTOKEN => $amount], $source);
  }

  public static function payMoney($player, $amount, $total, $source)
  {
    self::notifyAll('getBonuses', clienttranslate('${player_name} pays ${bonuses_desc} for ${source}'), [
      'i18n' => ['source'],
      'player' => $player,
      'source' => $source,
      'bonuses' => [MONEY => -$amount],
    ]);
  }

  public static function payXToken($player, $amount, $total, $source)
  {
    self::notifyAll('getBonuses', clienttranslate('${player_name} pays ${bonuses_desc} for ${source}'), [
      'i18n' => ['source'],
      'player' => $player,
      'source' => $source,
      'bonuses' => [XTOKEN => -$amount],
    ]);
  }

  ///////////////////////////////////////
  //  _____  __  __           _
  // | ____|/ _|/ _| ___  ___| |_ ___
  // |  _| | |_| |_ / _ \/ __| __/ __|
  // | |___|  _|  _|  __/ (__| |_\__ \
  // |_____|_| |_|  \___|\___|\__|___/
  ///////////////////////////////////////

  public static function sprint($player, $cards)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} for sprint effect'),
      clienttranslate('${player_name} draws ${n} card(s) for sprint effect')
    );
  }

  public static function preHunter($player, $cards)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} for hunter effect'),
      clienttranslate('${player_name} draws ${card_names} for hunter effect'),
      ['cards' => $cards->toArray()]
    );
  }

  public static function hunter($player, $cardsToDiscard, $card)
  {
    $noDiscard = count($cardsToDiscard) == 0;
    self::discardCards(
      $player,
      $cardsToDiscard,
      $noDiscard
        ? clienttranslate('You keep ${card_name} for hunter effect')
        : clienttranslate('You keep ${card_name} and discard ${card_names} for hunter effect'),
      $noDiscard
        ? clienttranslate('${player_name} keep ${card_name} card for hunter effect')
        : clienttranslate('${player_name} keep ${card_name} card and discard ${n} card(s) for hunter effect'),
      ['card' => $card],
      ['card' => $card]
    );
  }

  public static function failHunter($player, $cardsToDiscard)
  {
    self::discardCards(
      $player,
      $cardsToDiscard,
      clienttranslate('You discard ${card_names} (no animal)'),
      clienttranslate('${player_name} discard all ${n} card(s) of hunter effect (no animals)')
    );
  }

  public static function prePerception($player, $cards, $draw, $keep)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} for perception effect'),
      clienttranslate('${player_name} draws ${n} card(s) for perception effect')
    );
  }

  public static function perception($player, $cardsToDiscard, $cardsToKeep)
  {
    self::notifyAll(
      'discardCards',
      clienttranslate('${player_name} keep ${m} card(s) and discard ${n} card(s) for perception effect'),
      [
        'player' => $player,
        'n' => count($cardsToDiscard),
        'm' => count($cardsToKeep),
      ]
    );
    self::notify($player, 'pDiscardCards', clienttranslate('You keep ${card_names2} and discard ${card_names}'), [
      'player' => $player,
      'cards' => $cardsToDiscard->toArray(),
      'cards2' => $cardsToKeep->toArray(),
    ]);
  }

  public static function sunbathing($player, $cardsToSell, $money)
  {
    self::discardCards(
      $player,
      $cardsToSell,
      clienttranslate('You sell ${card_names} cards for ${bonuses_desc}'),
      clienttranslate('${player_name} sells ${n} card(s) for ${bonuses_desc}'),
      [
        'bonuses' => [MONEY => $money],
      ]
    );
  }

  public static function pouch($player, $cardsToPouch, $appeal)
  {
    self::discardCards(
      $player,
      $cardsToPouch,
      clienttranslate('You pouch ${card_names} cards for ${bonuses_desc}'),
      clienttranslate('${player_name} pouch ${n} card(s) for ${bonuses_desc}'),
      [
        'bonuses' => [APPEAL => $appeal],
        'score' => $player->updateScore(),
        'income' => $player->getMoneyIncome(),
      ]
    );
  }

  public static function digging($player, $type, $cardToDiscard, $card)
  {
    if ($type == 'hand') {
      self::discardCards(
        $player,
        $cardToDiscard,
        \clienttranslate('You dig ${card_names} from your hand'),
        \clienttranslate('${player_name} digs 1 card from their hand')
      );
    } else {
      self::discardCardsOnDisplay($player, $cardToDiscard, clienttranslate('${player_name} digs ${card_names} from the display'));
    }

    if (!is_null($card)) {
      self::drawCards($player, $card);
    }
  }

  public static function preScavenging($player, $cards)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} from discard for scavenging effect'),
      clienttranslate('${player_name} draws ${n} card(s) from discard for scavenging effect')
    );
  }

  public static function scavenging($player, $cardsToDiscard, $card)
  {
    self::discardCards(
      $player,
      $cardsToDiscard,
      clienttranslate('You keep ${card_name} and discard ${card_names} for scavenging effect'),
      clienttranslate('${player_name} keep 1 card and discard ${n} card(s) for scavenging effect'),
      [],
      ['card' => $card]
    );
  }

  public static function clever($player, $type, $position, $cards)
  {
    self::actionCardCleanup(
      $player,
      $type,
      $position,
      $cards,
      clienttranslate('${player_name} places ${card_type} at position ${position} (Clever effect)')
    );
  }

  public static function preResistance($player, $cards)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} for resistance effect'),
      clienttranslate('${player_name} draws ${n} scoring cards for resistance effect'),
      ['scoringCard' => true]
    );
  }

  public static function resistance($player, $cardsToDiscard, $card)
  {
    self::discardCards(
      $player,
      $cardsToDiscard,
      clienttranslate('You keep ${card_name} and discard ${card_names} for resistance effect'),
      clienttranslate('${player_name} keep 1 scoring card and discard ${n} scoring card for resistance effect'),
      ['scoringCard' => true],
      ['scoringCard' => true, 'card' => $card]
    );
  }

  public static function assertion($player, $card)
  {
    self::drawCards(
      $player,
      [$card],
      clienttranslate('You keep ${card_names} with Assertion'),
      clienttranslate('${player_name} keeps 1 card with Assertion')
    );
  }

  public static function dominance($player, $card)
  {
    $cards = [$card];
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You get ${card_names} with Dominance'),
      clienttranslate('${player_name} add ${card_names} conservation project to its hand with Dominance'),
      ['cards' => $cards]
    );
  }

  public static function constriction($player, $meeples, $players)
  {
    self::notifyAll(
      'addMeeples',
      clienttranslate('${player_name} use Constriction effect and gives constriction token(s) to ${players_names}'),
      ['player' => $player, 'meeples' => $meeples, 'players' => $players]
    );
  }

  public static function venom($player, $meeples, $players)
  {
    self::notifyAll(
      'addMeeples',
      clienttranslate('${player_name} use Venom effect and gives Venom token(s) to ${players_names}'),
      [
        'player' => $player,
        'meeples' => $meeples,
        'players' => $players,
      ]
    );
  }

  public static function multiplier($player, $actionCard, $meeple)
  {
    self::notifyAll(
      'addMeeples',
      clienttranslate(
        '${player_name} add a multiplier token on action card ${action_card_name}${action_card_icon}${action_card_level}'
      ),
      [
        'player' => $player,
        'meeples' => [$meeple],
        'actionCard' => $actionCard,
      ]
    );
  }

  public static function enableMultiplier($meeples)
  {
    self::notifyAll('enableMultiplier', '', [
      'meepleIds' => $meeples->getIds(),
    ]);
  }

  public static function useMultiplier($player, $meeple)
  {
    self::notifyAll('discardTokens', clienttranslate('${player_name} uses a multiplier token'), [
      'player' => $player,
      'meeples' => [$meeple],
    ]);
  }

  public static function discardToken($player, $type, $meeple, $silent = false)
  {
    self::notifyAll('discardTokens', $silent ? '' : clienttranslate('${player_name} discard its ${type} token'), [
      'player' => $player,
      'meeples' => [$meeple],
      'type' => $type,
      'i18n' => [$type],
    ]);
  }

  public static function useReductionTokens($player, $tokensUsed)
  {
    self::notifyAll('discardTokens', clienttranslate('${player_name} uses ${n} token(s) from sponsor card(s)'), [
      'player' => $player,
      'n' => count($tokensUsed),
      'meeples' => $tokensUsed,
    ]);
  }

  public static function hypnosis($player, $target)
  {
    self::notifyAll('hypnosis', clienttranslate('${player_name} chooses to hypnotize ${player_name2}'), [
      'player' => $player,
      'player2' => $target,
    ]);
  }

  public static function pilfering($player, $target1, $target2)
  {
    $msg = clienttranslate('${player_name} chooses ${player_name2} to Pilfer');
    if (!is_null($target1) && !is_null($target2)) {
      $msg = clienttranslate('${player_name} chooses ${player_name2} and ${player_name3} to Pilfer');
    }

    self::notifyAll('pilfering', $msg, [
      'player' => $player,
      'player2' => $target1 ?? $target2,
      'player3' => $target2,
    ]);
  }

  public static function pilferingCard($player, $card, $otherPlayer)
  {
    $cards = [$card];
    // Public notif : slide card
    self::notifyAll('pilferingCard', clienttranslate('${player_name} gives 1 card to ${player_name2} from Pilfering effect'), [
      'player' => $player,
      'player2' => $otherPlayer,
    ]);

    self::notify($player, 'pDiscardCards', 'You give ${card_names} from the Pilfering effect', [
      'player' => $player,
      'pilfering' => $otherPlayer->getId(),
      'cards' => $cards,
    ]);
    self::notify($otherPlayer, 'pDrawCards', clienttranslate('You get ${card_names} from the Pilfering effect'), [
      'player' => $otherPlayer,
      'pilfering' => $player->getId(),
      'cards' => $cards,
    ]);
  }

  public static function pilferingMoney($player, $amount, $otherPlayer)
  {
    self::notifyAll(
      'pilferingMoney',
      clienttranslate('${player_name} gives ${bonuses_desc} to ${player_name2} for Pilfering effect'),
      [
        'player' => $player,
        'player2' => $otherPlayer,
        'bonuses' => [MONEY => $amount],
      ]
    );
  }

  // FULL-THROATED
  public static function gainWorker($player, $worker)
  {
    self::notifyAll('slideMeeples', clienttranslate('${player_name} gains a new Association worker'), [
      'player' => $player,
      'meeples' => [$worker],
    ]);
  }

  public static function map8Effect($player, $cards)
  {
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} from the deck (Map 8 effect)'),
      clienttranslate('${player_name} draws ${card_names} sponsor card(s) from the deck (Map 8 effect)'),
      ['cards' => $cards->toArray()]
    );
  }

  public static function wazaSpecial($player, $type, $card)
  {
    self::notifyAll(
      'wazaSpecial',
      $type == 'small'
        ? \clienttranslate('${player_name} focuses on small animals and won\'t be able to play large animal from now on')
        : \clienttranslate('${player_name} focuses on large animals and won\'t be able to play small animal from now on'),
      [
        'player' => $player,
        'type' => $type,
      ]
    );

    $cards = [$card];
    self::drawCards(
      $player,
      $cards,
      clienttranslate('You draw ${card_names} from the deck (Waza Special Assignement effect)'),
      clienttranslate('${player_name} draws ${card_names} animal card from the deck (Waza Special Assignement effect)'),
      ['cards' => $cards]
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
  }
}

?>

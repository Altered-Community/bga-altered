<?php
namespace ALT\States;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Core\Preferences;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Managers\Meeples;
use ALT\Helpers\Log;

trait SetupTrait
{
  /*
   * setupNewGame:
   */
  protected function setupNewGame($players, $options = [])
  {
    Globals::setupNewGame($players, $options);
    Players::setupNewGame($players, $options);
    // Preferences::setupNewGame($players, $this->player_preferences);
    // Temp while we do not have API
    Cards::setupNewGame($players, $options);
    // Meeples::setupNewGame($players, $options);
    // Stats::checkExistence();

    Globals::setFirstPlayer($this->getNextPlayerTable()[0]);

    $this->setGameStateInitialValue('logging', false);
    $this->activeNextPlayer();
  }

  function stDeckSetup()
  {
    // Temp for the moment as no deck selection yet

    $this->gamestate->nextState('');
  }

  protected function setupPlayer($player, $notif = false)
  {
    $pId = $player->getId();
    $meeples = Meeples::setupPlayer($pId);
    // $cards = ActionCards::setupPlayer($pId);

    // // Create buildings for map A
    // $buildings = [];
    // $mapId = $player->getMapId();
    // Stats::setMap($player, $mapId == 'A' ? 100 : ((int) $mapId));
    // if ($mapId == 'A') {
    //   $buildings[] = Buildings::add($pId, 'size-3', ['x' => 0, 'y' => 9], 0);
    //   $buildings[] = Buildings::add($pId, 'kiosk', ['x' => 0, 'y' => 7], 0);
    //   Stats::incBuiltEnclosures($pId);
    //   Stats::incBuiltKiosks($pId);
    //   Stats::incCoveredHexes($pId, 4);
    // }

    // if ($notif) {
    //   Notifications::setupPlayer($player, $mapId, $cards, $meeples, $buildings);
    // }
  }

  // Deck selection
  function argsDeckSelection()
  {
    return [];
  }

  function stDeckSelection()
  {
    // Temporary while we get decks
    $this->gamestate->nextState('done');
  }

  function actDeckSelection()
  {
    //self::checkAction('actDeckSelection');
    // TODO
    $this->gamestate->nextState('done');
  }

  function stFirstDay()
  {
    $day = Globals::incDay(1);
    $nCards = 6;
    $pIds = [];

    // on first day, 6 cards are picked
    foreach (Players::getAll() as $pId => $player) {
      // put in specific location as they must be choosen
      $player->draw($nCards, 'deck_' . $pId, 'hand');
      $pIds[] = $pId;
    }
    Globals::setFirstDayManaSelection([]);
    $this->gamestate->setPlayersMultiactive($pIds, '', true);
    $this->gamestate->nextState('');
  }

  function argsFirstDayMana()
  {
    $selection = Globals::getFirstDayManaSelection();
    $args = ['_private' => []];
    foreach (Players::getAll() as $pId => $player) {
      $hand = $player->getHand();
      $args['_private'][$pId] = [
        'n' => 3,
        'cards' => $hand->getIds(),
        'selection' => $selection[$pId] ?? null,
      ];
    }

    return $args;
  }

  public function actFirstDayMana($cardIds)
  {
    self::checkAction('actFirstDayMana');
    $player = Players::getCurrent();

    if (count($cardIds) != 3) {
      throw new \BgaUserException(clienttranslate('You must select 4 cards to put as mana'));
    }
    $args = $this->argsFirstDayMana();
    if (!empty(array_diff($cardIds, $args['_private'][$player->getId()]['cards']))) {
      throw new \BgaUserException('You do not own this card. Should not happen');
    }

    $selection = Globals::getFirstDayManaSelection();
    $selection[$player->getId()] = $cardIds;
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateFirstDayManaSelection($player, self::argsFirstDayMana());

    $this->updateActivePlayersFirstDaySelection();
  }

  public function actCancelFirstDayMana()
  {
    $this->gamestate->checkPossibleAction('actCancelFirstDayMana');

    $player = Players::getCurrent();
    $selection = Globals::getFirstDayManaSelection();
    unset($selection[$player->getId()]);
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateFirstDayManaSelection($player, self::argsFirstDayMana());

    $this->updateActivePlayersFirstDaySelection();
  }

  public function updateActivePlayersFirstDaySelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getFirstDayManaSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $selection = Globals::getFirstDayManaSelection();
      foreach ($players as $pId => $player) {
        $cardIds = $selection[$pId];
        if (count($cardIds) != 3) {
          throw new \BgaUserException('4 cards should be put as mana. Should not happen');
        }
        $remainingIds = array_diff($player->getHand()->getIds(), $cardIds);

        $cards = Cards::getMany($cardIds);
        Cards::discard($cardIds, MANA);
        $cards = Cards::getMany($cardIds);
        // throw new \feException($cards->first()->getId());
        Notifications::discardMana($player, $cards, null, clienttranslate('${player_name} places ${n} cards as mana'));

        // Change of rules, not needed anymore
        // Cards::move($remainingIds, 'hand');
        // Notifications::moveToHand($player, Cards::getMany($remainingIds));
      }

      $this->gamestate->nextState('done');
    }
  }
}

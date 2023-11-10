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
    // Stats::checkExistence();

    Globals::setFirstPlayer($this->getNextPlayerTable()[0]);
    Players::initializeDecks();

    $this->setGameStateInitialValue('logging', false);
    $this->gamestate->setAllPlayersMultiactive();
    // $this->activeNextPlayer();
  }

  //////////////////////////////////////////////////////////////////
  //    ____ _                                _           _
  //   / ___| |__   ___   ___  ___  ___    __| | ___  ___| | __
  //  | |   | '_ \ / _ \ / _ \/ __|/ _ \  / _` |/ _ \/ __| |/ /
  //  | |___| | | | (_) | (_) \__ \  __/ | (_| |  __/ (__|   <
  //   \____|_| |_|\___/ \___/|___/\___|  \__,_|\___|\___|_|\_\
  //////////////////////////////////////////////////////////////////
  function getDeckHero($deckNumber)
  {
    return Cards::getInLocation("deck-$deckNumber")
      ->where('type', HERO)
      ->first();
  }

  function argsDeckSelection()
  {
    $args = [
      '_private' => [],
    ];
    $allDecks = Globals::getPlayerDecks();
    $selection = Globals::getDeckSelection();
    foreach (Players::getAll() as $pId => $player) {
      $decks = $allDecks[$pId];
      foreach ($decks as &$deck) {
        $deck['hero'] = $this->getDeckHero($deck['deckNum']);
      }
      $args['_private'][$pId]['decks'] = $decks;
      $args['_private'][$pId]['selection'] = $selection[$pId] ?? null;
    }

    return $args;
  }

  public function actSelectDeck($choice)
  {
    $this->gamestate->checkPossibleAction('actSelectDeck');

    $player = Players::getCurrent();
    $selection = Globals::getDeckSelection();
    $selection[$player->getId()] = $choice;
    Globals::setDeckSelection($selection);
    Notifications::updateInitialDeckSelection($player, self::argsDeckSelection());

    $this->updateActivePlayersDeckSelection();
  }

  public function actCancelDeckSelection()
  {
    $this->gamestate->checkPossibleAction('actCancelDeckSelection');

    $player = Players::getCurrent();
    $selection = Globals::getDeckSelection();
    unset($selection[$player->getId()]);
    Globals::setDeckSelection($selection);
    Notifications::updateInitialDeckSelection($player, self::argsDeckSelection());

    $this->updateActivePlayersDeckSelection();
  }

  public function updateActivePlayersDeckSelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getDeckSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $this->gamestate->nextState('done');
    }
  }

  function actGetDeck($deckNumber)
  {
    self::checkAction('actGetDeck');
    $player = Players::getCurrent();
    if (!in_array($deckNumber, array_keys(Globals::getPlayerDecks()[$player->getId()]))) {
      throw new \BgaVisibleSystemException('You do not have a deck with this number. Should not happen');
    }
    return $player->getDeck($deckNumber)->toArray();
  }

  // TODO : REMOVE ONCE WE GOT API
  function stDeckSelection()
  {
    // // Temporary while we get decks
    // $selection = [];
    // $pIds = Players::getAll()->getIds();
    // foreach ($pIds as $i => $pId) {
    //   $selection[$pId] = $i == 0 ? \FACTION_BR : FACTION_MU;
    // }
    // Globals::setDeckSelection($selection);

    // $this->gamestate->nextState('done');
  }

  /////////////////////////////////////////////////////////
  //  ____       _                     _           _
  // / ___|  ___| |_ _   _ _ __     __| | ___  ___| | __
  // \___ \ / _ \ __| | | | '_ \   / _` |/ _ \/ __| |/ /
  //  ___) |  __/ |_| |_| | |_) | | (_| |  __/ (__|   <
  // |____/ \___|\__|\__,_| .__/   \__,_|\___|\___|_|\_\
  //                      |_|
  /////////////////////////////////////////////////////////

  function stDeckSetup()
  {
    $selection = Globals::getDeckSelection();
    foreach (Players::getAll() as $pId => $player) {
      $deckNumber = $selection[$pId];

      // delete all other cards
      $toDel = Cards::getFiltered($pId)->whereNot('location', "deck-$deckNumber");
      Cards::delete($toDel->getIds());

      // updating Cards
      $hero = $this->getDeckHero($deckNumber);
      $hero->setLocation("board-hero-$pId");
      Cards::getFiltered($pId)
        ->where('location', "deck-$deckNumber")
        ->update('location', "deck-$pId");

      // faction setup
      $player->setFaction(Globals::getPlayerDecks()[$pId][$deckNumber]['faction']);
      $meeples = Meeples::setupPlayer($player);

      // shuffling of dec
      Cards::shuffle("deck-$pId");
      Notifications::setupDeck($player, $meeples, $hero);
    }

    // TODO : remove ???
    //    Notifications::setupCards(Cards::getUiData());

    $this->gamestate->nextState('');
  }

  protected function setupPrecoDeck($player, $faction)
  {
    $player->setFaction($faction);
    $meeples = Meeples::setupPlayer($player);
    Cards::setupPrecoDeck($player);
    Notifications::setupPreco($player, $meeples);
  }
}

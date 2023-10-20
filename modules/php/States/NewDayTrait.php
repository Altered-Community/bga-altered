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

trait NewDayTrait
{
  // Clear previous stuff and draw new cards
  function stNewDay()
  {
    if (Players::checkVictory()) {
      return;
    }

    $day = Globals::incDay(1);
    $nCards = 0;

    // First day
    if ($day == 1) {
      $nCards = 6;
    }
    // Normal new day
    else {
      $nCards = 2;
      Globals::setStormMoves([]);
      Cards::untapAll();

      // Change first player
      $currentFirstPId = Globals::getFirstPlayer();
      $newFirstPId = Players::getNextId($currentFirstPId);
      Globals::setFirstPlayer($newFirstPId);
      Notifications::newFirstPlayer(Players::get($newFirstPId));
    }

    // Draw cards and make everyone active
    $pIds = [];

    // on new day, x cards are picked
    foreach (Players::getAll() as $pId => $player) {
      // put in specific location as they must be choosen
      $player->draw($nCards);
      $pIds[] = $pId;
    }

    Globals::setNewDayManaSelection([]);
    $this->gamestate->setPlayersMultiactive($pIds, '', true);
    $this->gamestate->nextState('');
  }

  // Choose card(s) to put as mana
  function argsNewDayManaSelection()
  {
    $isFirstDay = Globals::getDay() == 1;
    $selection = Globals::getNewDayManaSelection();
    $args = [
      'descSuffix' => $isFirstDay ? 'firstday' : '',
      'canPass' => !$isFirstDay,
      '_private' => [],
    ];

    foreach (Players::getAll() as $pId => $player) {
      $hand = $player->getHand();
      $args['_private'][$pId] = [
        'n' => $isFirstDay ? 3 : 1,
        'cards' => $hand->getIds(),
        'selection' => $selection[$pId] ?? null,
      ];
    }

    return $args;
  }

  public function actNewDayManaSelection($cardIds)
  {
    self::checkAction('actNewDayManaSelection');
    $player = Players::getCurrent();
    $args = $this->argsNewDayManaSelection()['_private'][$player->getId()];

    if (count($cardIds) != $args['n']) {
      throw new \BgaUserException(clienttranslate('You must select the correct number of cards to put as mana'));
    }
    if (!empty(array_diff($cardIds, $args['cards']))) {
      throw new \BgaUserException('Invalid card to select. Should not happen');
    }

    $selection = Globals::getNewDayManaSelection();
    $selection[$player->getId()] = $cardIds;
    Globals::setNewDayManaSelection($selection);
    Notifications::updateNewDayManaSelection($player, self::argsNewDayManaSelection());

    $this->updateActivePlayersNewDayManaSelection();
  }

  public function actCancelNewDayManaSelection()
  {
    $this->gamestate->checkPossibleAction('actCancelNewDayManaSelection');

    $player = Players::getCurrent();
    $selection = Globals::getNewDayManaSelection();
    unset($selection[$player->getId()]);
    Globals::setNewDayManaSelection($selection);
    Notifications::updateNewDayManaSelection($player, self::argsNewDayManaSelection());

    $this->updateActivePlayersNewDayManaSelection();
  }

  public function actPassNewDayManaSelection()
  {
    self::checkAction('actPassNewDayManaSelection');
    $args = $this->argsNewDayManaSelection();
    if (!$args['canPass']) {
      throw new \BgaUserException('You cant pass. Should not happen');
    }

    $player = Players::getCurrent();
    $selection = Globals::getNewDayManaSelection();
    $selection[$player->getId()] = [];
    Globals::setNewDayManaSelection($selection);
    Notifications::updateNewDayManaSelection($player, self::argsNewDayManaSelection());

    $this->updateActivePlayersNewDayManaSelection();
  }

  public function updateActivePlayersNewDayManaSelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getNewDayManaSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $selection = Globals::getNewDayManaSelection();
      foreach ($players as $pId => $player) {
        $cardIds = $selection[$pId];
        if (empty($cardIds)) {
          continue;
        }

        Cards::discard($cardIds, MANA);
        $cards = Cards::getMany($cardIds);
        Notifications::discardMana($player, $cards, null, clienttranslate('${player_name} choses ${n} card(s) as mana'));
      }
      if (Globals::getDay() > 1) {
        $this->checkCardListeners('Dawn', ST_BEFORE_ASSIGNMENT);
      } else {
        $this->gamestate->nextState('done');
      }
    }
  }
}

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
  function stFirstDay()
  {
    $this->newDayDraw(6);
  }

  function stNewDay()
  {
    // Change first player
    Globals::setFirstPlayer(Players::getNextId(Globals::getFirstPlayer()));
    Notifications::newFirstPlayer(Players::get(Globals::getFirstPlayer()));
    // untap cards
    Cards::untapAll();
    $this->newDayDraw(2);
  }

  function newDayDraw($nCards)
  {
    $day = Globals::incDay(1);
    $pIds = [];

    // on new day, x cards are picked
    foreach (Players::getAll() as $pId => $player) {
      // put in specific location as they must be choosen
      $player->draw($nCards, 'deck-' . $pId, 'hand');
      $pIds[] = $pId;
    }
    Globals::setFirstDayManaSelection([]);
    $this->gamestate->setPlayersMultiactive($pIds, '', true);
    $this->gamestate->nextState('');
  }

  function argsNewDay()
  {
    $selection = Globals::getFirstDayManaSelection();
    $args = ['_private' => []];
    foreach (Players::getAll() as $pId => $player) {
      $hand = $player->getHand();
      $args['_private'][$pId] = [
        'n' => $this->gamestate->state()['name'] == 'newDayMana' ? 1 : 3,
        'cards' => $hand->getIds(),
        'selection' => $selection[$pId] ?? null,
      ];
    }

    return $args;
  }

  public function actDayMana($cardIds)
  {
    self::checkAction('actDayMana');
    $player = Players::getCurrent();
    $args = $this->argsNewDay()['_private'][$player->getId()];

    if (count($cardIds) != $args['n']) {
      throw new \BgaUserException(clienttranslate('You must select the correct number of cards to put as mana'));
    }
    if (!empty(array_diff($cardIds, $args['cards']))) {
      throw new \BgaUserException('You do not own this card. Should not happen');
    }

    $selection = Globals::getFirstDayManaSelection();
    $selection[$player->getId()] = $cardIds;
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateDayManaSelection($player, self::argsNewDay());

    $this->updateActivePlayersNewDaySelection();
  }

  public function actCancelFirstDayMana()
  {
    $this->gamestate->checkPossibleAction('actCancelFirstDayMana');

    $this->actCancelNewDayMana(false);
  }

  public function actCancelNewDayMana($check = true)
  {
    if ($check === true) {
      $this->gamestate->checkPossibleAction('actCancelNewDayMana');
    }

    $player = Players::getCurrent();
    $selection = Globals::getFirstDayManaSelection();
    unset($selection[$player->getId()]);
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateDayManaSelection($player, self::argsNewDay());

    $this->updateActivePlayersNewDaySelection();
  }

  public function actPassNewDay()
  {
    self::checkAction('actPassNewDay');
    $player = Players::getCurrent();
    $selection = Globals::getFirstDayManaSelection();
    $selection[$player->getId()] = [];
    Globals::setFirstDayManaSelection($selection);
    Notifications::updateDayManaSelection($player, self::argsNewDay());

    $this->updateActivePlayersNewDaySelection();
  }

  public function updateActivePlayersNewDaySelection()
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

        // $remainingIds = array_diff($player->getHand()->getIds(), $cardIds);

        if (empty($cardsIds)) {
          // nothing to do if no card was discarded
          continue;
        }
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

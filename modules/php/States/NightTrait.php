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

trait NightTrait
{
  /************
   ****NIGHT **
   *************/

  function stBeforeNight()
  {
    // TODO: awaiting FAQ answer
    // TODO: check victory
    $this->checkCardListeners('BeforeNight', 'stPreNight');
  }

  function stPreNight()
  {
    $skipped = [];
    $enabled = [];
    foreach (Players::getAll() as $pId => $player) {
      if ($player->nightCleanup() === false) {
        $skipped[$pId] = [];
      } else {
        $enabled[] = $pId;
      }
    }
    Globals::setSkippedPlayers($skipped);

    // ok for all players
    if (count($skipped) == Players::getAll()->count()) {
      // New day
      $this->gamestate->jumpToState(ST_BEFORE_ASSIGNMENT);
      // $this->gamestate->jumpToState(ST_NEW_DAY);temporary
    } else {
      Globals::setNightSelection($skipped);
      $this->gamestate->setPlayersMultiactive($enabled, '', true);
      $this->gamestate->jumpToState(ST_NIGHT);
    }
  }

  function argsNight()
  {
    $selection = Globals::getNightSelection();
    foreach (Players::getAll() as $pId => $player) {
      $memory = $player->getMemoryCards();
      $args['_private'][$pId] = [
        'n' => $memory->count() - $player->getMemorySlots(),
        'cards' => $memory->getIds(),
        'selection' => $selection[$pId] ?? null,
      ];
    }

    return $args;
  }

  public function actNightChoice($cardIds)
  {
    self::checkAction('actNightChoice');
    $player = Players::getCurrent();
    $args = $this->argsNight();

    if (count($cardIds) != $args['_private'][$player->getId()]['n']) {
      throw new \BgaUserException(clienttranslate('You must select the correct number of cards to discard'));
    }
    if (!empty(array_diff($cardIds, $args['_private'][$player->getId()]['cards']))) {
      throw new \BgaUserException('You do not own this card. Should not happen');
    }

    $selection = Globals::getNightSelection();
    $selection[$player->getId()] = $cardIds;
    Globals::setNightSelection($selection);
    Notifications::updateNightSelection($player, self::argsNight());

    $this->updateActivePlayersNightSelection();
  }

  public function actCancelNight()
  {
    $this->gamestate->checkPossibleAction('actCancelNight');

    $player = Players::getCurrent();
    $selection = Globals::getNightSelection();
    unset($selection[$player->getId()]);
    Globals::setNightSelection($selection);
    Notifications::updateNightSelection($player, self::argsNight());

    $this->updateActivePlayersNightSelection();
  }

  public function updateActivePlayersNightSelection()
  {
    // Compute players that still need to select their card
    // => use that instead of BGA framework feature because in some rare case a player
    //    might become inactive eventhough the selection failed (seen in Agricola and Rauha at least already)
    $selection = Globals::getNightSelection();
    $players = Players::getAll();
    $ids = $players->getIds();
    $ids = array_diff($ids, array_keys($selection));

    // At least one player need to make a choice
    if (!empty($ids)) {
      $this->gamestate->setPlayersMultiactive($ids, 'done', true);
    }
    // Everyone is done => discard cards and proceed
    else {
      $selection = Globals::getNightSelection();
      foreach ($players as $pId => $player) {
        $cardIds = $selection[$pId];

        $cards = Cards::getMany($cardIds);
        Cards::discard($cardIds);
        $cards = Cards::getMany($cardIds);
        // throw new \feException($cards->first()->getId());
        Notifications::discard($player, $cards, null, clienttranslate('${player_name} discards ${n} cards from the reserve'));
      }

      $this->gamestate->nextState('done');
    }
  }
}

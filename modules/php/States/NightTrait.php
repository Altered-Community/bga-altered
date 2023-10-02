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
    // TODO: check victory
    $this->checkCardListeners('BeforeNight', 'stPreNight');
  }

  function stPreNight()
  {
    Globals::setSkippedPlayers([]);
    Globals::setPlayedCards(1);
    $this->initCustomDefaultTurnOrder('nightPhase', \ST_NIGHT, ST_NEW_DAY, true);
  }

  public function stNight()
  {
    $player = Players::getActive();
    // check if a player skipped his turn
    $skipped = Globals::getSkippedPlayers();

    if (in_array($player->getId(), $skipped)) {
      // Everyone has discarded
      $remaining = array_diff(Players::getAll()->getIds(), $skipped);
      if (empty($remaining)) {
        $this->endCustomOrder('nightPhase');
      } else {
        $this->nextPlayerCustomOrder('nightPhase');
      }
      return;
    }

    // if the player has no need to discard
    $toDiscard = $player->nightCleanup();

    if ($toDiscard === false) {
      $skipped[] = $player->getId();
      Globals::setSkippedPlayers($skipped);
      $this->nextPlayerCustomOrder('nightPhase');
      return;
    }

    self::giveExtraTime($player->getId(), 20);

    // Stats::incTurns($player);
    $node = [
      'childs' => [
        [
          'action' => DISCARD,
          'pId' => $player->getId(),
          'args' => [
            'source' => MEMORY,
            'destination' => 'discard',
            'n' => $player->getMemoryCards()->count() - $player->getMemorySlots(),
          ],
        ],
      ],
    ];

    // Inserting leaf Action card
    Engine::setup($node, ['order' => 'nightPhase']);
    Engine::proceed();
  }
}

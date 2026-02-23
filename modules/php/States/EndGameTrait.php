<?php

namespace ALT\States;

use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Engine;
use ALT\Core\Stats;
use ALT\Helpers\Log;
use ALT\Managers\Players;
use ALT\Managers\Meeples;
use ALT\Managers\Cards;

trait EndGameTrait
{
  function stPreEndOfGame($concede = false)
  {
    // TODO: API call
    $request = [];
    foreach (Players::getAll() as $pId => $player) {
      if (Stats::getWinner($player) == 0) {
        $request['loser'] = [
          'id' => $pId,
          'faction' => $player->getFaction() == FACTION_OD ? 'OR' : $player->getFaction()
        ];
      } else {
        $request['winner'] = [
          'id' => $pId,
          'faction' => $player->getFaction() == FACTION_OD ? 'OR' : $player->getFaction()
        ];
      }
    }
    if (!Globals::getZombie() || Globals::getDay() >= 4) {
      $valid = self::getGenericGameInfos('push_adventure_pass', $request);

      Notifications::message(
        clienttranslate('The game has ended. Calculating BGA Adventure pass progress...'),
        []
      );
      if ($valid['success'] == 1 && isset($valid['winner_bga_adventure_pass_progress']) && !is_null($valid['winner_bga_adventure_pass_progress'])) {
        Notifications::message(
          clienttranslate('${player_name} increased the BGA Adventure pass to ${pass}'),
          [
            'player' => Players::get($request['winner']['id']),
            'pass' => $valid['winner_bga_adventure_pass_progress']
          ]
        );
      }
      if ($valid['success'] == 1 && isset($valid['loser_bga_adventure_pass_progress']) && !is_null($valid['loser_bga_adventure_pass_progress'])) {
        Notifications::message(
          clienttranslate('${player_name} increased the BGA Adventure pass to ${pass}'),
          [
            'player' => Players::get($request['loser']['id']),
            'pass' => $valid['loser_bga_adventure_pass_progress']
          ]
        );
      }
    }
    // throw new \feException(print_r($valid));
    // TODO remove in alpha
    // [success] => 1
    // [transaction_id] => 01KG2N443JATCX4XYH55Q30PGT
    // [winner_adventure_pass_point] => 0
    // [winner_bga_adventure_pass_progress] => 3/15
    // [loser_adventure_pass_point] => 
    // [loser_bga_adventure_pass_progress] => 
    if ($this->getBgaEnvironment() == 'studio') {
      // throw new \feException(print_r(debug_print_backtrace()));
      throw new \feException('winner');
    }
    if (!$concede) {
      $this->gamestate->nextState('');
    }
  }

  /*
    function stLaunchEndOfGame()
    {
      foreach (ZooCards::getAllCardsWithMethod('EndOfGame') as $card) {
        $card->onEndOfGame();
      }
      Globals::setTurn(15);
      Globals::setLiveScoring(true);
      Scores::update(true);
      Notifications::seed(Globals::getGameSeed());
      $this->gamestate->jumpToState(\ST_END_GAME);
    }
    */
}

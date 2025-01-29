<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Globals;
use ALT\Helpers\Log;
use ALT\Core\Game;
use ALT\Helpers\FT;

class RollDie extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_ROLL_DIE;
  }

  public function getDescription()
  {
    list($nTotal, $extraRolls) = $this->getN();

    return [
      'log' => clienttranslate('Roll ${n} die'),
      'args' => [
        'n' => $nTotal,
      ],
    ];
  }

  public function getN($player = null)
  {
    $n = $this->getCtxArg('n') ?? 1;

    $player = $player ?? Players::getActive();

    // Lyra Bastion management
    $extraRolls = $player->getAddDice();

    return [$n + $extraRolls, $extraRolls];
  }

  public function isAutomatic($player = null)
  {
    return true;
  }

  public function isIrreversible($player = null)
  {
    return true;
  }

  protected $args = [
    'n' => 1,
    'effect' => [],
    'canDiscard' => false,
    'hasRolled' => false,
  ];

  public function getSource()
  {
    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    return $source;
  }

  private function getGain($roll)
  {
    $effect = null;
    foreach ($this->getArg('effect') as $qty => $gain) {
      $lower = 0;
      $upper = null;

      // Quantity of the form : X-Y
      if (\stripos($qty, '-') !== false) {
        $t = \explode('-', $qty);
        $lower = (int) $t[0];
        $upper = (int) $t[1];
      }
      // Quantity of the form : X+
      elseif (\stripos($qty, '+') !== false) {
        $t = \explode('+', $qty);
        $lower = (int) $t[0];
      }
      // Quantity is just an int
      else {
        $lower = (int) $qty;
        $upper = (int) $qty;
      }

      // Check $n against $lower and $upper
      if ($roll >= $lower && ($upper === null || $roll <= $upper)) {
        if ($effect != null) {
          throw new \feException("Duplicate effect found for roll : $roll");
        }
        $effect = $gain;
      }
    }
    if ($effect == 'OPPOSITE') {
      return null;
    }
    return $effect;
  }

  public function stPreRollDie()
  {
    $player = Players::getActive();
    list($nTotal, $extraRolls) = $this->getN();
    $rolls = [];

    $source = $this->getSource();
    if ($this->getArg('hasRolled')) {
      return;
    }

    if ($extraRolls > 0) {
      Notifications::message(clienttranslate('${n} dice are added to the roll (Ouroboros Lyra Bastion\'s effect)'), [
        'n' => $extraRolls,
      ]);
    }
    // $fake = 5;
    for ($i = 0; $i < $nTotal; $i++) {
      $roll = bga_rand(1, 6);
      if (Game::get()->getBgaEnvironment() == 'studio') {
        $roll = 2;
      }
      $rolls[] = $roll;
    }

    // TODO: add power to increment die result
    $newRolls = [];
    $addRoll = $player->getAddRoll();
    foreach ($rolls as $roll) {
      $newRolls[] = $roll;
      for ($i = 1; $i <= $addRoll; $i++) {
        $newRolls[] = $roll + $i;
      }
    }

    Notifications::roll($player, $rolls, $source);
    Globals::setDiceRolls($newRolls);
    Log::checkpoint(true);
  }

  public function argsRollDie()
  {
    $canDiscard =
      $this->getArg('canDiscard') &&
      Players::getActive()
      ->getReserveCards()
      ->count() > 0;

    return [
      'rolls' => array_values(array_unique(Globals::getDiceRolls(), SORT_NUMERIC)),
      'canDiscard' => $canDiscard,
      'cardIds' => Players::getActive()
        ->getReserveCards()
        ->getIds(),
      'descSuffix' => $canDiscard ? 'bastion' : '',
    ];
  }

  public function stRollDie()
  {
    $args = $this->argsRollDie();
    // throw new \feException(print_r(debug_print_backtrace()));

    if (!$args['canDiscard'] && count($args['rolls']) == 1) {
      // $this->actRollDie($args['rolls'][0]);
      return [$args['rolls'][0]];
    }
  }

  public function actRollDie($dieValue)
  {

    $player = Players::getActive();
    $source = $this->getSource();
    $effects = [];

    $effect = $this->getGain($dieValue);
    if ($effect !== null) {
      $effect = Utils::updateTree($effect, 'die', $dieValue);
      $effect['sourceId'] = $source->getId();
      $effect = Utils::tagTree($effect, ['sourceId' => $source->getId()]);
      $cardId = $this->getCtxArg('cardId') ?? null;
      if (!is_null($cardId) && isset($effect['args']['cardId']) && $effect['args']['cardId'] != ME) {
        $effect['args']['cardId'] = $cardId;
      }
      $effects[] = $effect;
    }

    if (count($effects) > 1) {
      // TODO: see if we will need seq/or/etc.
      $this->insertAsChild(['type' => NODE_XOR, 'childs' => $effects]);
    } elseif (count($effects) == 1) {
      $this->insertAsChild($effects[0]);
    }

    $this->checkAfterListeners($player, ['rolls' => Globals::getDiceRolls(), 'sourceId' => $source->getId()]);

    Globals::setDiceRolls([]);
    $this->resolveAction([$dieValue]);
  }

  public function actDiscardAdd($cardId)
  {
    $player = Players::getActive();
    $source = $this->getSource();
    $args = $this->argsRollDie();

    if (count(array_diff($cardId, $args['cardIds'])) != 0) {
      throw new \BgaVisibleSystemException('You cannot target this card. should not happen');
    }
    $this->duplicateAction(['canDiscard' => false, 'hasRolled' => true]);
    $this->insertAsChild(FT::ACTION(DISCARD, ['cardId' => $cardId]));

    $rolls = Globals::getDiceRolls();
    foreach ($rolls as $roll) {
      $newRolls[] = $roll + 2;
    }
    Globals::setDiceRolls($newRolls);
    Notifications::message(clienttranslate('${player_name} discards ${card_name} to add 2 to its rolls.'), [
      'player' => $player,
      'card' => Cards::get($cardId),
    ]);
  }
}

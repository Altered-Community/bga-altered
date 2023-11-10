<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

class RollDie extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_ROLL_DIE;
  }

  public function getDescription()
  {
    $n = $this->getCtxArg('n') ?? 1;

    return [
      'log' => clienttranslate('Roll ${n} die'),
      'args' => [
        'n' => $n,
      ],
    ];
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
  ];

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
      // Quantity of the form : +X
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

    return $effect;
  }

  public function stRollDie()
  {
    $player = Players::getActive();
    $n = $this->getArg('n');
    $rolls = [];
    $effects = [];

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }
    for ($i = 0; $i < $n; $i++) {
      $roll = bga_rand(1, 6);
      $rolls[] = $roll;
      $effect = $this->getGain($roll);
      if ($effect !== null) {
        $effect = Utils::updateTree($effect, 'die', $roll);
        $effect['sourceId'] = $source->getId();
        $effects[] = $effect;
      }
    }

    Notifications::roll($player, $rolls, $source);

    if (count($effects) > 1) {
      // TODO: see if we will need seq/or/etc.
      $this->insertAsChild(['type' => NODE_XOR, 'childs' => $effects]);
    } elseif (count($effects) == 1) {
      $this->insertAsChild($effects[0]);
    }

    $this->resolveAction($rolls, true);
  }
}

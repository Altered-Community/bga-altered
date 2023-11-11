<?php
namespace ALT\Actions;
use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Core\Engine;

class Resupply extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_RESUPPLY;
  }

  public function getDescription()
  {
    return [
      'log' => clienttranslate('Put ${n} from deck to reserve'),
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

  public function getPlayer()
  {
    $pId = $this->getCtxArg('pId') ?? Players::getActiveId();
    return Players::get($pId);
  }

  protected $args = [
    'n' => 1,
  ];

  public function stResupply()
  {
    $n = $this->getArg('n');
    $player = $this->getPlayer();

    $source = $this->ctx->getSource() ?? null;
    $sourceId = $this->ctx->getSourceId() ?? null;
    if (is_null($source) && !is_null($sourceId)) {
      $source = Cards::getSingle($sourceId);
    }

    $player->draw(
      $n,
      'deck-' . $player->getId(),
      RESERVE,
      $source,
      clienttranslate('You put ${card_names} from your deck in Reserve (${card_name2}\'s effect)'),
      clienttranslate('${player_name} places ${n} card(s) from its deck to Reserve (${card_name2}\'s effect)')
    );
    $this->checkAfterListeners($player, ['draw' => $n]);

    $this->resolveAction(null, true);
  }
}

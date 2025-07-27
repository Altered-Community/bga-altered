<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;
use ALT\Core\Stats;
use ALT\Helpers\Utils;
use ALT\Helpers\FT;
use ALT\Core\Engine;

class MarkRegion extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MARK_REGION;
  }

  public function getDescription()
  {
    return clienttranslate('Mark a visible region');
  }

  protected $args = [];

  public function argsMarkRegion()
  {

    return [
      'regions' => Globals::getVisibleRegions(),
      'markers' => $this->getMarkers()
    ];
  }

  public function getMarkers()
  {
    $source = Cards::get($this->getSourceId());
    return Meeples::getOfType('card-' . $source->getId(), [OCEAN, FOREST, MOUNTAIN]);
  }

  public function isDoable($player)
  {
    return count($this->getMarkers()) > 0;
  }

  public function actMarkRegion($markerId, $stormId)
  {
    $args = $this->argsMarkRegion();
    if (!isset($args['markers'][$markerId])) {
      throw new \BgaVisibleSystemException('Invalid terrain marker. Should not happen');
    }

    // move the marker
    $marker = $args['markers'][$markerId];
    $marker->setLocation('storm-' . $stormId);

    // Notify
    Notifications::setTerrainMarker(Players::getActive(), Meeples::get($markerId), $this->getSource());
    $this->resolveAction([$markerId, $stormId]);
  }
}

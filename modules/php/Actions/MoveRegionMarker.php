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

class MoveRegionMarker extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MOVE_REGION_MARKER;
  }

  public function getDescription()
  {
    return clienttranslate('Move a region terrain marker');
  }

  protected $args = [
    'markerType' => null
  ];

  public function argsMoveRegionMarker()
  {

    return [
      'markerType' => $this->getArg('markerType'),
      'markers' => $this->getMarkers()
    ];
  }

  public function getMarkers()
  {
    $types = [$this->getArg('markerType')];
    return Meeples::getOfType('storm-%', $types);
  }

  public function isDoable($player)
  {
    return count($this->getMarkers()) > 0;
  }

  public function isOptional($player)
  {
    return true;
  }

  public function actMoveRegionMarker($markerId)
  {
    $args = $this->argsMoveRegionMarker();
    if (!isset($args['markers'][$markerId])) {
      throw new \BgaVisibleSystemException('Invalid terrain marker. Should not happen');
    }

    // move the marker
    $marker = $args['markers'][$markerId];
    $source = $this->getSource();
    if ($source->getLocation() == STORM_LEFT) {
      $playerToken = 'getHeroToken';
    } else {
      $playerToken = 'getCompanionToken';
    }

    $marker->setLocation($source->getPlayer()->$playerToken()->getLocation());
    $marker->setState(Meeples::getNextPlayedMarker());

    // Notify
    Notifications::moveTerrainMarker(Players::getActive(), Meeples::get($markerId), $this->getSource());
    $this->resolveAction([$markerId]);
  }
}

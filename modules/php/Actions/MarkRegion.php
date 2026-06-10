<?php

namespace ALT\Actions;

use ALT\Managers\Meeples;
use ALT\Managers\Players;
use ALT\Managers\Cards;
use ALT\Core\Globals;
use ALT\Core\Notifications;

class MarkRegion extends \ALT\Models\Action
{
  public function getState()
  {
    return ST_MARK_REGION;
  }

  public function getDescription()
  {
    if ($this->getArg('create') === true) {
      $descriptions = [
        FOREST => clienttranslate('Place a {V} Terrain Marker on target visible region.'),
        MOUNTAIN => clienttranslate('Place a {M} Terrain Marker on target visible region.'),
        OCEAN => clienttranslate('Place a {O} Terrain Marker on target visible region.'),
      ];
      $regionType = $this->getArg('regionType');
      if (isset($descriptions[$regionType])) {
        return ['log' => $descriptions[$regionType], 'args' => []];
      }
    }

    return clienttranslate('Mark a visible region');
  }

  protected $args = [
    'create' => false,
    'regionType' => null
  ];

  public function argsMarkRegion()
  {
    $args = [
      'regions' => Globals::getVisibleRegions(),
      'markers' => $this->getMarkers(),
    ];

    if ($this->getArg('create') === true) {
      $args['regionType'] = $this->getArg('regionType');
      $args['descSuffix'] = 'create';
    }

    return $args;
  }

  public function getMarkers()
  {
    $source = Cards::get($this->getSourceId());
    return Meeples::getOfType('card-' . $source->getId(), [OCEAN, FOREST, MOUNTAIN]);
  }

  public function isDoable($player)
  {
    return count($this->getMarkers()) > 0 || $this->getArg('create') === true;
  }

  public function stPreMarkRegion()
  {
    if ($this->getArg('create') === true) {
      $marker = Meeples::singleCreate(['type' => $this->getArg('regionType'), 'location' => 'card-' . $this->getSourceId(), 'player_id' => Players::getCurrentId()]);
    }
  }

  public function actMarkRegion($markerId, $stormId)
  {
    $args = $this->argsMarkRegion();
    if (!isset($args['markers'][$markerId])) {
      throw new \BgaVisibleSystemException('Invalid terrain marker. Should not happen');
    }

    // TODO : manage tiebreaker

    // move the marker
    $marker = $args['markers'][$markerId];
    $marker->setLocation('storm-' . $stormId);
    $marker->setState(Meeples::getNextPlayedMarker());

    // Notify
    Notifications::setTerrainMarker(Players::getActive(), Meeples::get($markerId), $this->getSource());
    $this->resolveAction([$markerId, $stormId]);
  }
}

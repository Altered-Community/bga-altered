<?php
namespace ALT\Cards\YZ;

class YZ_Rare_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_R2',
      'asset' => 'ALT_CORE_B_OR_29_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Grand Endeavor',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'The Ordis built a relay of lighthouses to light the way through the Tumult.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — Target Expedition moves forward one region.',
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

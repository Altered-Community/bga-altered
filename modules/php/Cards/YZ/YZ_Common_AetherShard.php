<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_AetherShard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_29_C',
      'asset' => 'ALT_CORE_B_YZ_29_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Aether Shard',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'No mere trinket, but a fragment of purest dream.',
      'artist' => 'Anh Tung',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'At Noon — Draw a card.',
      'costHand' => 5,
      'costReserve' => 5,
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(DRAW, ['players' => ME])
        ]
      ]
    ];
  }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_IsareePebble extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_65_C',
      'asset'  => 'ALT_CYCLONE_B_AX_65_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Isaree & Pebble"),
      'typeline' => clienttranslate("Axiom Hero"),
      'type'  => HERO,
      'thumbnail' => 4,
      'statData' => 19,
      'flavorText'  => clienttranslate('Science\'s role is to serve the people, not the other way around'),
      'artist' => "Justice Wong",

      'extension' => 'SO',
      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectDesc' => clienttranslate('At Noon — If you are first player, create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isFirstPlayer',
          'output' => [
            'action' => INVOKE_TOKEN,
            'automatic' => true,
            'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
          ],
        ],
      ],
    ];
  }
}

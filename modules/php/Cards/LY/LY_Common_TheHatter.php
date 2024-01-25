<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_TheHatter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_18_C',
      'asset' => 'ALT_CORE_B_LY_18_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'The Hatter',
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('(*He can\'t swim.*)'),
      'supportDesc' =>
        '{D} : Target Character with Hand Cost {3} or less gains [ANCHORED]. (Discard me from Reserve to do this.)',
        'supportIcon' => 'discard',
        'forest' => 5,
      'mountain' => 5,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 5,
      'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
      'typeline' => 'Character - Citizen',
      'artist' => 'Zero Wen',
      'flavorText' =>
        "\"You can draw water out of a water-well, so I should think you could draw treacle out of a treacle-well — eh, stupid ?\"",
];
  }
}

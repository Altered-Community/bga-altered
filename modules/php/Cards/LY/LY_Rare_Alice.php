<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Alice extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_13_R2',
      'asset' => 'ALT_CORE_B_YZ_13_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Alice'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"One good turn deserves another."'),
      'artist' => 'Taras Susak',
      'subtypes' => [CITIZEN],
      'supportDesc' => clienttranslate('{D} : <AFTER_YOU>. (Discard me from Reserve to do this.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain'],
      'effectSupport' => FT::ACTION(AFTER_YOU, []),
      'supportIcon' => 'discard',
    ];
  }
}

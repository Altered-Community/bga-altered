<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Athena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_18_C',
      'asset' => 'ALT_CORE_B_AX_18_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Athena',
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => '{R} If you control two or more Landmarks, I lose <FLEETING_CHAR>.',
      'flavorText' => '"I’ve lifted the mist from off your eyes that’s blurred them up to now."',
      'typeline' => 'Character - Deity',
      'artist' => 'Zero Wen',

      'forest' => 3,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 3,
      'effectReserve' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl:landmark:2',
        'effect' => FT::LOOSE(ME, FLEETING),
      ]),
    ];
  }
}

<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_R2',
      'asset' => 'ALT_CORE_B_MU_06_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Spindle Harvesters',
      'typeline' => 'Character - Animal Plant',
      'type' => CHARACTER,
      'flavorText' => 'Some say the harvesters are the caretakers of the world-trees.',
      'artist' => 'Ba Vo',
      'subtypes' => [ANIMAL, PLANT],
      'effectDesc' => '{J} I gain $<ANCHORED>.',
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::GAIN($this, ANCHORED),

    ];
  }
}

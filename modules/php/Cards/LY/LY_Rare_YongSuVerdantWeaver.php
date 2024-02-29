<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_YongSuVerdantWeaver extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_10_R2',
      'asset' => 'ALT_CORE_B_MU_10_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Yong-Su, Verdant Weaver',
      'typeline' => 'Character - Druid',
      'type' => CHARACTER,
      'flavorText' => 'Green is good.',
      'artist' => 'Kevin Sidharta',
      'subtypes' => [DRUID],
      'effectDesc' => '{J} #If you have three or more base statistics of 0 among Characters you control,# I gain 2 boosts.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'has3WithZeroStat', 'effect' => FT::GAIN($this, BOOST, 2)]),

    ];
  }
}

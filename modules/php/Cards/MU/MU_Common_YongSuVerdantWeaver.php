<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_YongSuVerdantWeaver extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_10_C',
      'asset' => 'ALT_CORE_B_MU_10_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Yong-Su, Verdant Weaver'),
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'effectDesc' => clienttranslate(
        '{J} If you control two or more Plants, I gain 2 boosts$<BB>. (Cards in Reserve are not controlled.)'
      ),
      'flavorText' => clienttranslate('Green is good.'),
      'artist' => 'Kevin Sidharta',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasControl:plant:2', 'effect' => FT::GAIN($this, BOOST, 2)]),
    ];
  }
}

<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_MunaDruid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_13_C',
      'asset' => 'ALT_CORE_B_MU_13_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Muna Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'supportDesc' => clienttranslate(
        '{D} : Target Character with Hand Cost {3} or less gains [ANCHORED]. (Discard me from Reserve to do this.)'
      ),
      'supportIcon' => 'discard',
      'typeline' => clienttranslate('Character - Druid'),
      'flavorText' => clienttranslate("\"We are the sentinels of the Skein, always keeping a finger on the pulse of nature.\""),
      'artist' => 'Ba Vo',

      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}

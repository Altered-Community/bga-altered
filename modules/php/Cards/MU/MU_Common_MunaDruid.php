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
      'subtype' => [DRUID],
      'supportDesc' => clienttranslate(
        '{D} : Target Character with hand cost {3} or less becomes [ANCHORED]. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}

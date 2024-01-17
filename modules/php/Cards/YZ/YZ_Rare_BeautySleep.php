<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_R2',
      'asset' => 'ALT_CORE_B_MU_28_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Beauty Sleep'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('Target Character gains $[ASLEEP].'),
      'costHand' => 1,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, ASLEEP)]),
    ];
  }
}

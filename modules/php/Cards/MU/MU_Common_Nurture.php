<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_C',
      'asset' => 'ALT_CORE_B_MU_27_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Nurture'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Up to two target Characters each gain 1 boost$[BB].'),
      'costHand' => 2,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
      'typeline' => clienttranslate('Spell - Boon'),
    ];
  }
}

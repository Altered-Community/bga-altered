<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_R2',
      'asset' => 'ALT_CORE_B_MU_27_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Nurture'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'flavorText' => clienttranslate('When the sun shines, we\'ll shine together.'),
      'artist' => 'Zero Wen',
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Up to two target Characters each gain 1 boost.'),
      'costHand' => 2,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(TARGET, ['upTo' => true, 'n' => 2, 'effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
    ];
  }
}

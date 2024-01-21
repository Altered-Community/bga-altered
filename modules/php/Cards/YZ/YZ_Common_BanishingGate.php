<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_BanishingGate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_24_C',
      'asset' => 'ALT_CORE_B_YZ_24_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Banishing Gate'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('$[FLEETING].  Discard target Character or Permanent.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::ACTION(DISCARD, [])])
      )
    ];
  }
}

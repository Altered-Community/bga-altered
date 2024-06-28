<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_HelpingHand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_25_R2',
      'asset' => 'ALT_CORE_B_BR_25_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Helping Hand',
      'typeline' => 'Spell - Boon',
      'type' => SPELL,
      'flavorText' => 'Never gonna give you up.',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [BOON],
      'effectDesc' => 'Target Character gains 1 boost and loses <FLEETING_CHAR>.',
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, [
        'effect' => FT::SEQ(FT::GAIN(EFFECT, BOOST), FT::LOOSE(EFFECT, FLEETING)),
      ]),
    ];
  }
}

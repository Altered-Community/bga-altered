<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_23_C',
      'asset' => 'ALT_CORE_B_OR_23_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Charge!'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Characters you control gain 1 boost$[BB]. (Cards in Reserve are not controlled.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['targetPlayer' => ME, 'n' => INFTY, 'effect' => FT::GAIN($this, BOOST)])
      ),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'flavorText' => clienttranslate(
        'Facing terrible odds and an unfathomably huge Leviathan, the Ordis legion charged nonetheless.'
      ),
      'artist' => 'Zero Wen',
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_28_C',
      'asset' => 'ALT_CORE_B_BR_28_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Intimidation'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Return target Character or Permanent with Hand Cost {4} or less to its owner\'s hand.'
      ),
      'typeline' => clienttranslate('Spell - Disruption'),
      'flavorText' => clienttranslate('The terrible beast shrank and cowered before the might of the Bravos.'),
      'artist' => 'Nestor Papatriantafyllou',

      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['maxHandCost' => 4, 'targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::RETURN_TO_HAND()])
      ),
    ];
  }
}

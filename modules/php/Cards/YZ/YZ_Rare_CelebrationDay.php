<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_R2',
      'asset' => 'ALT_CORE_B_OR_27_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Celebration Day',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' =>
      'Today, and for centuries to come, we will celebrate victory over the Kraken and revel in freedom regained!',
      'artist' => 'Matteo Spirito',
      'subtypes' => [MANEUVER],
      'effectDesc' => '$<FLEETING>.  #Expeditions# can\'t move forward this Day.',
      'costHand' => 8,
      'costReserve' => 8,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(BLOCK_EXPEDITION, ['expedition' => 'all'])
      )
    ];
  }
}

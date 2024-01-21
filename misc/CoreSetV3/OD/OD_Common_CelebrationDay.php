<?php
namespace ALT\Cards\OD;

class OD_Common_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_C',
      'asset' => 'ALT_CORE_B_OR_27_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Celebration Day',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' =>
        'Today, and for centuries to come, we will celebrate victory over the Kraken and revel in freedom regained!',
      'artist' => 'Matteo Spirito',
      'subtypes' => [MANEUVER],
      'effectDesc' => '$[FLEETING].  Target Expedition can\'t move forward this Day.',
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

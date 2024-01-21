<?php
namespace ALT\Cards\YZ;

class YZ_Common_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_C',
      'asset' => 'ALT_CORE_B_YZ_25_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Small Step, Giant Leap',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' => 'The journey of a thousand miles begins with one step.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [MANEUVER],
      'effectDesc' => '$[FLEETING].  Target Expedition moves forward.',
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

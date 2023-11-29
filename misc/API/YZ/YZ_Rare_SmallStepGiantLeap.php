<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_R1',
      'asset' => 'ALT_CORE_B_YZ_25_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Small Step, Giant Leap'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate('Target Expedition moves forward.'),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

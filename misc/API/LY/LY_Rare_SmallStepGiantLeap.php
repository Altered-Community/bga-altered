<?php
namespace ALT\Cards\LY;

class LY_Rare_SmallStepGiantLeap extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_25_R2',
      'asset' => 'ALT_CORE_B_YZ_25_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Small Step, Giant Leap'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Target Expedition moves forward.'
      ),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

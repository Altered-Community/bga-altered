<?php
namespace ALT\Cards\LY;

class LY_Common_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_C',
      'asset' => 'ALT_CORE_B_LY_24_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Cloth Cocoon'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Choose one:  • Discard target [FLEETING_CHAR], [ANCHORED] or [ASLEEP] Character.  • Discard target Permanent.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

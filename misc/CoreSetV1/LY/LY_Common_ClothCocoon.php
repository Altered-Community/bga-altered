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
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate(
        '$[FLEETING]. Choose one:  - Discard target [FLEETING], [ANCHORED] or [ASLEEP] Character.  - Discard target Permanent.  '
      ),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

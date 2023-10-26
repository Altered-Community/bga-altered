<?php
namespace ALT\Cards\LY;

class LY_Common_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '88',
      'asset' => 'LY-49_Cloth_Cocoon_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Cloth Cocoon'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '[[Fleeting]]. Choose one:  - Discard target [[Fleeting]], [[Anchored]] or [[Asleep]] Character.  - Discard target Permanent.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

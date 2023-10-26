<?php
namespace ALT\Cards\LY;

class LY_Common_LyraClothDancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '77',
      'asset' => 'Z-SLUSH_LY-18_Kasirga_Wind-Dancer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Cloth-Dancer'),
      'type' => CHARACTER,
      'subtype' => 'Artist',
      'typeline' => 'Common - Artist',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} Another target Character becomes [[Fleeting]].'),
      'reminders' => clienttranslate('(Fleeting: If I would be sent to Reserve, banish me instead.)'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

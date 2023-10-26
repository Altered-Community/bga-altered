<?php
namespace ALT\Cards\LY;

class LY_Common_Esmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '75',
      'asset' => 'Z-SLUSH_LY-38_Esmeralda_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Esmeralda'),
      'type' => CHARACTER,
      'subtype' => 'Artist',
      'typeline' => 'Common - Artist',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{M} [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

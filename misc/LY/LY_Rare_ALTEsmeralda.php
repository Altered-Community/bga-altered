<?php
namespace ALT\Cards\LY;

class LY_Rare_ALTEsmeralda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '95',
      'asset' => 'Z-SLUSH_LY-38_Esmeralda_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('ALT Esmeralda'),
      'type' => CHARACTER,
      'subtype' => 'Artist',
      'typeline' => 'Rare - Artist',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('<{J}> [Resupply].'),
      'reminders' => clienttranslate('(Resupply: Put the top card of your deck in your Reserve.)'),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

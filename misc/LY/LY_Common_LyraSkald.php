<?php
namespace ALT\Cards\LY;

class LY_Common_LyraSkald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '70',
      'asset' => 'LY-19_Mnemos_Skald_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Skald'),
      'type' => CHARACTER,
      'subtype' => 'Artist',
      'typeline' => 'Common - Artist',
      'rarity' => RARITY_COMMON,

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

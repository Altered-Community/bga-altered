<?php
namespace ALT\Cards\LY;

class LY_Common_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '80',
      'asset' => 'LY-37_Scheherezade_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Chronicler'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Common - Citizen',
      'rarity' => RARITY_COMMON,

      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

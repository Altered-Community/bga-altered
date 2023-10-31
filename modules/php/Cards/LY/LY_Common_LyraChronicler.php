<?php
namespace ALT\Cards\LY;

class LY_Common_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '80',
      'asset' => 'LY-16-Scheherezade-C',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Lyra Chronicler'),
      'typeline' => clienttranslate('Common - Citizen'),
      'rarity' => RARITY_COMMON,
      'type' => CHARACTER,
      'subtype' => 'Citizen',

      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

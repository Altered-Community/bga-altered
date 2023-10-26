<?php
namespace ALT\Cards\OD;

class OD_Common_OrdisCadets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '132',
      'asset' => 'OR-27_Training Grounds_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ordis Cadets'),
      'type' => CHARACTER,
      'subtype' => 'Soldier',
      'typeline' => 'Common - Soldier',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} Create a [1/1/1 Ordis Recruit] Soldier token in my Expedition.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

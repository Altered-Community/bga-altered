<?php
namespace ALT\Cards\OD;

class OD_Common_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '138',
      'asset' => 'OR-37_Ozma_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Ozma'),
      'type' => CHARACTER,
      'subtype' => 'Citizen',
      'typeline' => 'Common - Citizen',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} If you control at least 3 other Characters, draw a card.'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

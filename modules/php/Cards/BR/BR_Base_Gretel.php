<?php
namespace ALT\Cards\BR;

class BR_Base_Gretel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_5',
      'asset' => 'BR-07_Gretel_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Gretel'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Base - Adventurer',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate(''),

      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

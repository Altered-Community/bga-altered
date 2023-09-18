<?php
namespace ALT\Cards\BR;

class BR_Base_Gretel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-07_Gretel_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Gretel'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'rarity' => RARITY_BASE,
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

<?php
namespace ALT\Cards\BR;

class BR_Base_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR_20_Atlas_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Atlas'),
      'type' => EXPLORER,
      'subtype' => 'Titan',
      'rarity' => RARITY_BASE,
      'forest' => 3,
      'mountain' => 3,
      'water' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}

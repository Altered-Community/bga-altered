<?php
namespace ALT\Cards\BR;

class BR_Base_Mulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-36_Hua_Mulan_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Mulan'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'rarity' => RARITY_BASE,
      'forest' => 2,
      'mountain' => 4,
      'water' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

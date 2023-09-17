<?php
namespace ALT\Cards\MU;

class MU_Base_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-43_ConiferalConeman_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Coniferal Coneman'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'rarity' => RARITY_BASE,
      'forest' => 3,
      'mountain' => 3,
      'water' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}

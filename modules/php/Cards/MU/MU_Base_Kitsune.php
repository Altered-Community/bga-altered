<?php
namespace ALT\Cards\MU;

class MU_Base_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU-09_Kitsune_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Kitsune'),
      'type' => EXPLORER,
      'subtype' => 'Spirit',
      'rarity' => RARITY_BASE,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

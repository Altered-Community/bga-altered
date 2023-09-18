<?php
namespace ALT\Cards\MU;

class MU_Base_MusubiHarvester extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'MU_06_MusubiHarvester_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Musubi Harvester'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'rarity' => RARITY_BASE,
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Base_MusubiHarvester extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_19',
      'asset' => 'MU_06_MusubiHarvester_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Musubi Harvester'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'typeline' => 'Explorer Base - Plant',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),

      'reminders' => clienttranslate('Anchored: At Night, I don\'t go to Reserve and I lose Anchored.'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

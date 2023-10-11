<?php
namespace ALT\Cards\MU;

class MU_Base_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_21',
      'asset' => 'MU-36_Sneezer_Shroom_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'typeline' => 'Explorer Base - Plant',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),

      'reminders' => clienttranslate('Anchored: At Night, I don\'t go to Reserve and I lose Anchored.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

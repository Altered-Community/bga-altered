<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Base_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_1_25',
      'asset' => 'MU-43_ConiferalConeman_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Coniferal Coneman'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'typeline' => 'Explorer Base - Plant',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),

      'reminders' => clienttranslate('Anchored: At Night, I don\'t go to Reserve and I lose Anchored.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
    ];
  }
}

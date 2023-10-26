<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_GloriousMushroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_2_2_30',
      'asset' => 'MU-36_Sneezer_Shroom_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Glorious Mushroom'),
      'type' => EXPLORER,
      'subtype' => 'Plant',
      'typeline' => 'Explorer Rare - Plant',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate('{J} I become [[Anchored]].  [G]At Dawn — I gain 1 boost.[/G]'),

      'reminders' => clienttranslate('Anchored: At Night, I don\'t go to Reserve and I lose Anchored.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
      'effectPlayed' => FT::GAIN($this, ANCHORED),
      'effectPassive' => ['Dawn' => ['output' => FT::GAIN($this, BOOST)]],
    ];
  }
}

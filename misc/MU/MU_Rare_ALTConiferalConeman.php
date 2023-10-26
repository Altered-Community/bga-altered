<?php
namespace ALT\Cards\MU;

class MU_Rare_ALTConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '125',
      'asset' => 'MU-43_ConiferalConeman_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('ALT Coniferal Coneman'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Rare - Plant',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{J} I become [[Anchored]]. '),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}

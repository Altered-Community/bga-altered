<?php
namespace ALT\Cards\MU;

class MU_Rare_ALTConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '125',
      'asset' => 'MU-20-ConiferalConeman-R',

      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('ALT Coniferal Coneman'),
      'typeline' => clienttranslate('Rare - Plant'),
      'rarity' => RARITY_RARE,
      'type' => CHARACTER,
      'subtype' => 'Plant',

      'effectDesc' => clienttranslate('{J} I become [[Anchored]]. '),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'changedStats' => ['costHand', 'costMemory'],
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costMemory' => 4,
    ];
  }
}

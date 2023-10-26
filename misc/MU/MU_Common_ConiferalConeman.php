<?php
namespace ALT\Cards\MU;

class MU_Common_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '118',
      'asset' => 'MU-43_ConiferalConeman_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Coniferal Coneman'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Common - Plant',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}

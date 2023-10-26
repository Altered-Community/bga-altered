<?php
namespace ALT\Cards\MU;

class MU_Common_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '104',
      'asset' => 'MU-36_Sneezer_Shroom_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Common - Plant',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

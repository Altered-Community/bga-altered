<?php
namespace ALT\Cards\MU;

class MU_Rare_SneezerShroom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '127',
      'asset' => 'MU-36_Sneezer_Shroom_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Sneezer Shroom'),
      'type' => CHARACTER,
      'subtype' => 'Plant',
      'typeline' => 'Rare - Plant',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('{J} I become [[Anchored]].  <At Dawn � I gain 1 boost.>'),
      'reminders' => clienttranslate(
        '(Anchored: At Night, I don\'t go to Reserve and I lose Anchored. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

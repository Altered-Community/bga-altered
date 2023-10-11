<?php
namespace ALT\Cards\MU;

class MU_Base_ResilienceTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_MU_3_1_26',
      'asset' => 'MU-35_Mana_Web_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Resilience Training'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Spell Base - ',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('Target Character of hand cost {3} or less becomes [[Anchored]].'),

      'reminders' => clienttranslate('Anchored: At Night, I don\'t go to Reserve and I lose Anchored.'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

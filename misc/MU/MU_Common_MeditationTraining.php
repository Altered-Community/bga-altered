<?php
namespace ALT\Cards\MU;

class MU_Common_MeditationTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '120',
      'asset' => 'MU-35_Mana_Web_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Meditation Training'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('Target Character of hand cost {3} or less becomes [[Anchored]].'),
      'reminders' => clienttranslate('(Anchored: At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

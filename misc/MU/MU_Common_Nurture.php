<?php
namespace ALT\Cards\MU;

class MU_Common_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '123',
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Nurture'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('Up to two target Characters gain 1 boost.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Rare_ALTNurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '126',
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_02',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('ALT Nurture'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Rare - ',
      'rarity' => RARITY_RARE,

      'effectDesc' => clienttranslate('Up to two target Characters gain <2> boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

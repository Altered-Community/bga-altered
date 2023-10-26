<?php
namespace ALT\Cards\BR;

class BR_Common_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '58',
      'asset' => 'BR-17_GerichtVanBraast_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Physical Training'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('Target Character gains 3 boosts.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

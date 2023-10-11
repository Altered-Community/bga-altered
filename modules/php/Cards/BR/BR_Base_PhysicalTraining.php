<?php
namespace ALT\Cards\BR;

class BR_Base_PhysicalTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_3_1_11',
      'asset' => 'BR-17_GerichtVanBraast_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Physical Training'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Spell Base - ',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('Target Character gains 3 boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

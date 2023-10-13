<?php
namespace ALT\Cards\BR;

class BR_Base_Mulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_7',
      'asset' => 'BR-36_Hua_Mulan_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Mulan'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Base - Adventurer',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
      'effectMemory' => [[BOOST => 2]],
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Base_ArtificialDew extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_MU_3_1_27',
      'asset' => 'MU-49_Nurturing_Watering_Can_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_MU,
      'name' => clienttranslate('Artificial Dew'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Spell Base',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('Up to 2 target Characters gain 1 boost.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

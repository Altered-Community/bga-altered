<?php
namespace ALT\Cards\BR;

class BR_Base_Ratatosk extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_3',
      'asset' => 'BR-38_Ratatoskr_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatosk'),
      'type' => EXPLORER,
      'subtype' => 'Squirrel',
      'typeline' => 'Explorer Base - Squirrel',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{S} I gain 2 boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

<?php
namespace ALT\Cards\BR;

class BR_Rare_MulanRespectedLeader extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_2_13',
      'asset' => 'BR-36_Hua_Mulan_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Mulan, Respected Leader'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Rare - Adventurer',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate('{S} I gain 2 boosts <and lose [[Fleeting]].>'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

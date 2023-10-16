<?php
namespace ALT\Cards\BR;

class BR_Rare_RatatosktheNimble extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_2_15',
      'asset' => 'BR-38_Ratatoskr_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatosk, the Nimble'),
      'type' => EXPLORER,
      'subtype' => 'Squirrel',
      'typeline' => 'Explorer Rare - Squirrel',
      'rarity' => RARITY_RARE,
      'effectDesc' => clienttranslate('{S} I gain [G]3[/G] boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
      'effectMemory' => [[BOOST => 3]],
    ];
  }
}

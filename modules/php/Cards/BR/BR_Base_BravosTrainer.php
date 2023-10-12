<?php
namespace ALT\Cards\BR;

class BR_Base_BravosTrainer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_6',
      'asset' => 'OR-33_Aegis Veteran_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Trainer'),
      'type' => EXPLORER,
      'subtype' => 'Bowmaster',
      'typeline' => 'Explorer Base - Bowmaster',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{S} Target Character gains 2 boosts.'),

      'reminders' => clienttranslate(
        'Boosts are +1/+1/+1 counters. Remove them when the boosted Character leaves the Expedition Zone.'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costMemory' => 2,
      'effectMemory' => [[TARGET_ALL_EXPLORER => [[BOOST => 2]]]],
    ];
  }
}

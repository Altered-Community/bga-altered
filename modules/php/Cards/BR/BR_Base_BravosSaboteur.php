<?php
namespace ALT\Cards\BR;

class BR_Base_BravosSaboteur extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_8',
      'asset' => 'BR-19_MiskiCalderon_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Saboteur'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'typeline' => 'Explorer Base - Adventurer',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('{M} [Sabotage].'),

      'reminders' => clienttranslate('Sabotage: Banish up to one target card from a Reserve.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 3,
      'costMemory' => 3,
      'effectHand' => [[SABOTAGE => 1]],
    ];
  }
}

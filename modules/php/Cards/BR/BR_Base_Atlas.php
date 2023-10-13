<?php
namespace ALT\Cards\BR;

class BR_Base_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'USA2023_BR_2_1_10',
      'asset' => 'BR_20_Atlas_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Atlas'),
      'type' => EXPLORER,
      'subtype' => 'Titan',
      'typeline' => 'Explorer Base - Titan',
      'rarity' => RARITY_BASE,
      'effectDesc' => clienttranslate('[Gigantic].'),

      'reminders' => clienttranslate('Gigantic: At Dusk, I am considered present in both your Expeditions.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 5,
      'costMemory' => 5,
      'effectHand' => [[GIGANTIC => 1]],
      'effectMemory' => [[GIGANTIC => 1]],
    ];
  }
}

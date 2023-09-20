<?php
namespace ALT\Cards\BR;

class BR_Base_BravosSaboteur extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-19_MiskiCalderon_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Saboteur'),
      'type' => EXPLORER,
      'subtype' => 'Adventurer',
      'rarity' => RARITY_BASE,
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

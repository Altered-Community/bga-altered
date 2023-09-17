<?php
namespace ALT\Cards\BR;

class BR_Base_BravosTrainer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'OR-33_Aegis Veteran_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Bravos Trainer'),
      'type' => EXPLORER,
      'subtype' => 'Bowmaster',
      'rarity' => RARITY_BASE,
      'forest' => 2,
      'mountain' => 2,
      'water' => 2,
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

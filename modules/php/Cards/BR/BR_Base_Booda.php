<?php
namespace ALT\Cards\BR;

class BR_Base_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BRext1',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Booda'),
      'type' => EXPLORER,
      'subtype' => 'Token — Cat',
      'rarity' => RARITY_BASE,
      'forest' => 2,
      'mountain' => 2,
      'water' => 2,
    ];
  }
}

<?php
namespace ALT\Cards\BR;

class BR_Base_Ratatosk extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-38_Ratatoskr_01',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatosk'),
      'type' => EXPLORER,
      'subtype' => 'Squirrel',
      'rarity' => RARITY_BASE,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

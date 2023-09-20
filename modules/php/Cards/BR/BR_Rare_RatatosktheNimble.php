<?php
namespace ALT\Cards\BR;

class BR_Rare_RatatosktheNimble extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'asset' => 'BR-38_Ratatoskr_02',
      'frameSize' => 1,

      'faction' => FACTION_BR,
      'name' => clienttranslate('Ratatosk, the Nimble'),
      'type' => EXPLORER,
      'subtype' => 'Squirrel',
      'rarity' => RARITY_RARE,
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

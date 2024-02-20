<?php
namespace ALT\Cards\LY;

class LY_Common_Asmodeus extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_20_C',
      'asset' => 'ALT_CORE_B_LY_20_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Asmodeus'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Wanna play a game?'),
      'artist' => 'Zero Wen',
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{J} Roll a die. On a 4+, I gain $<ANCHORED>. On a 1-3, I gain 3 boosts$<BB>.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

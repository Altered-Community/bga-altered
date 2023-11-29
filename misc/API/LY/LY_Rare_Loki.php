<?php
namespace ALT\Cards\LY;

class LY_Rare_Loki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_21_R1',
      'asset' => 'ALT_CORE_B_LY_21_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Loki'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{M} Each player discards their hand and their Reserve, then draws three cards.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}

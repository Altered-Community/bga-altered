<?php
namespace ALT\Cards\LY;

class LY_Rare_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_20_R2',
      'asset' => 'ALT_CORE_B_MU_20_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Coniferal Coneman',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => "\"Dosukoi! Let’s put it in the ground!\"",
      'artist' => 'Damian Audino',
      'subtypes' => [PLANT],
      'effectDesc' => '{J} I gain $[ANCHORED].',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}

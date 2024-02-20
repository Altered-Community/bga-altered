<?php
namespace ALT\Cards\BR;

class BR_Rare_LyraNavigator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_12_R2',
      'asset' => 'ALT_CORE_B_LY_12_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Navigator',
      'typeline' => 'Character - Citizen',
      'type' => CHARACTER,
      'flavorText' => 'The black liquid traced shapes on the stone, and from these lines sprang innumerable creatures of soot.',
      'artist' => 'Taras Susak',
      'subtypes' => [CITIZEN],
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\LY;

class LY_Rare_BravosPathfinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_08_R2',
      'asset' => 'ALT_CORE_B_BR_08_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Bravos Pathfinder',
      'typeline' => 'Character - Adventurer',
      'type' => CHARACTER,
      'flavorText' => "\"Stay on the path, they say. I make my own path!\"",
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [ADVENTURER],
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

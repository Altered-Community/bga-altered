<?php
namespace ALT\Cards\BR;

class BR_Common_BravosPathfinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_08_C',
      'asset' => 'ALT_CORE_B_BR_08_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Bravos Pathfinder'),
      'type' => CHARACTER,
      'subtype' => ADVENTURER,
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

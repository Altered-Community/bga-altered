<?php
namespace ALT\Cards\OD;

class OD_Rare_OrdisTrooper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_05_R1',
      'asset' => 'ALT_CORE_B_OR_05_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ordis Trooper'),
      'typeline' => clienttranslate('Character - Soldier'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

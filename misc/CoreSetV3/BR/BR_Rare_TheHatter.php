<?php
namespace ALT\Cards\BR;

class BR_Rare_TheHatter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_18_R2',
      'asset' => 'ALT_CORE_B_LY_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'The Hatter',
      'typeline' => 'Character - Citizen',
      'type' => CHARACTER,
      'flavorText' =>
        '"You can draw water out of a water-well, so I should think you could draw treacle out of a treacle-well — eh, stupid ?"',
      'artist' => 'Zero Wen',
      'subtypes' => [CITIZEN],
      'supportDesc' =>
        '{D} : Target Character with Hand Cost {3} or less gains [ANCHORED]. (Discard me from Reserve to do this.)',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 5,
    ];
  }
}

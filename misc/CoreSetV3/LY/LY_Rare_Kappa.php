<?php
namespace ALT\Cards\LY;

class LY_Rare_Kappa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_13_R2',
      'asset' => 'ALT_CORE_B_BR_13_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Kappa',
      'typeline' => 'Character - Spirit Trainer',
      'type' => CHARACTER,
      'flavorText' => "\"Push through the pain. Giving up would hurt far more.\"",
      'artist' => 'Matteo Spirito',
      'subtypes' => [SPIRIT, TRAINER],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

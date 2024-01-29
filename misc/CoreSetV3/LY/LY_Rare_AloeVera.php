<?php
namespace ALT\Cards\LY;

class LY_Rare_AloeVera extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_16_R2',
      'asset' => 'ALT_CORE_B_MU_16_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Aloe Vera',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => 'Moisturizing every day is essential.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [PLANT],
      'effectDesc' => '#{J} You may pay {1} to have me gain $<ANCHORED>.#  At Noon — $<RESUPPLY>.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

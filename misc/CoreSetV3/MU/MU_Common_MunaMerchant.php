<?php
namespace ALT\Cards\MU;

class MU_Common_MunaMerchant extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_23_C',
      'asset' => 'ALT_CORE_B_MU_23_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Muna Merchant',
      'typeline' => 'Character - Citizen',
      'type' => CHARACTER,
      'flavorText' => "\"What do you need?\"",
      'artist' => 'Ba Vo',
      'subtypes' => [CITIZEN],
      'effectDesc' => '{R} $[RESUPPLY].',
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}

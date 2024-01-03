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
      'name' => clienttranslate('Muna Merchant'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{R} [Resupply]. (Put the top card of your deck in Reserve.)'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
    ];
  }
}

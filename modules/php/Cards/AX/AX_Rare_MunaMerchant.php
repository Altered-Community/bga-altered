<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_MunaMerchant extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_23_R2',
      'asset' => 'ALT_CORE_B_MU_23_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Muna Merchant'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"What do you need?"'),
      'artist' => 'Ba Vo',
      'subtypes' => [CITIZEN],
      'effectDesc' => clienttranslate('{R} $<RESUPPLY>.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
      'effectReserve' => FT::ACTION(RESUPPLY, []),
    ];
  }
}

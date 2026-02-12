<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_VendingBot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_91_R1',
      'asset'  => 'ALT_DUSTER_B_AX_91_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Vending Bot"),
      'typeline' => clienttranslate("Character - Robot Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Sap Cola! Pepsap! Guaranteed sugar-free!"'),
      'artist' => "Anh Tung",
      'extension' => 'SDU',
      'subtypes'  => [ROBOT, MERCHANT],
      'effectDesc' => clienttranslate('{R} <EXHAUSTED_RESUPPLY>.'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain', 'costHand'],
      'effectReserve' => FT::ACTION(RESUPPLY, ['exhausted' => true])
    ];
  }
}

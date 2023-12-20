<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_Loki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_21_C',
      'asset' => 'ALT_CORE_B_LY_21_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Loki'),
      'type' => CHARACTER,
      'subtype' => [DIVINITY],
      'effectDesc' => clienttranslate('{M} Each player discards their hand, then draws 3 cards.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 5,
      'effectHand' => FT::SEQ(
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'discardAllHand']),
        FT::ACTION(DRAW, ['n' => 3])
      )
    ];
  }
}

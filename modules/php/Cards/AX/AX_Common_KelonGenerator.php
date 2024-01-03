<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_KelonGenerator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_27_C',
      'asset' => 'ALT_CORE_B_AX_27_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kelon Generator'),
      'type' => PERMANENT,
      'subtype' => [LANDMARK],
      'effectDesc' => clienttranslate('{2}, {T} : Draw a card.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectTap' => FT::SEQ(FT::ACTION(PAY, ['pay' => 2]), FT::ACTION(DRAW, ['players' => ME])),
    ];
  }
}

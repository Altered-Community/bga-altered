<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_KelonicGenerator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_27_C',
      'asset' => 'ALT_CORE_B_AX_27_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Kelonic Generator',
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'typeline' => 'Permanent - Landmark',
      'flavorText' => "\"Suspira's mines will soon run dry. Your precious Kelon will run dry.\"",
      'artist' => 'Jean-Baptiste Andrier',

      'effectDesc' => '{2}, {T} : Draw a card.',
      'costHand' => 3,
      'costReserve' => 3,
      'effectTap' => FT::SEQ(FT::ACTION(PAY, ['pay' => 2]), FT::ACTION(DRAW, ['players' => ME])),
    ];
  }
}

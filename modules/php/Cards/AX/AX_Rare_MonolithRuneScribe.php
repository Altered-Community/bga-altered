<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_MonolithRuneScribe extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_07_R2',
      'asset' => 'ALT_CORE_B_OR_07_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Monolith Rune-Scribe'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('The Ordis manifest their Alteration through the use of glyphs of power.'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [SCHOLAR],
      'effectDesc' => clienttranslate('#{H} If you control a token, $<RESUPPLY_LOW>.#'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasControl:token:1', 'effect' => FT::ACTION(RESUPPLY, [])]),
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_ManaChannelling extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_27_C',
      'asset' => 'ALT_CORE_B_BR_27_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mana Channelling'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('$[FLEETING]  Put the top card of your deck in your Mana Orbs, exhausted.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(FT::GAIN($this, FLEETING), FT::ACTION(DRAW_MANA, [])),
    ];
  }
}

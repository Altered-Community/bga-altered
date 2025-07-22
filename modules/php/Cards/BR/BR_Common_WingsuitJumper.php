<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_WingsuitJumper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_72_C',
      'asset'  => 'ALT_CYCLONE_B_BR_72_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Wingsuit Jumper"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('What\'s important is not the landing, but the fall.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{R} You may <RUSH> to draw a card. (Rush means playing another card immediately.)'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectReserve' => FT::SEQ_OPTIONAL(
        FT::RUSH(),
        FT::ACTION(DRAW, ['players' => ME])
      )
    ];
  }
}

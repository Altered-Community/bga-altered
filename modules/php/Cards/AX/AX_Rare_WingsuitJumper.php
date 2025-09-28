<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_WingsuitJumper extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_72_R2',
      'asset'  => 'ALT_CYCLONE_B_BR_72_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
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

<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_KarhuLordofBears extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_MU_113_R2',
      'asset'  => 'ALT_EOLE_B_MU_113_R',
      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Karhu, Lord of Bears"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Karhu, my old friend, wake from your slumber." — Rin'),
      'artist' => "Matteo Spirito",
      'extension' => 'ROC',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} If you control another Animal #or an Artist,# draw a card.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION,
        ['condition' => 'hasControl:animal|artist:1:true', 'effect' => FT::ACTION(DRAW, ['players' => ME])]
      ),
    ];
  }
}

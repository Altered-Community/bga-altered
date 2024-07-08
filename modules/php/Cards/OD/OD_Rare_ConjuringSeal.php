<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_R2',
      'asset' => 'ALT_CORE_B_YZ_23_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Conjuring Seal'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'flavorText' => clienttranslate('The Imagination shapes our reality just as our beliefs shaped the Æther.'),
      'artist' => 'Khoa Viet',
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('Draw two cards.'),
      'costHand' => 3,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(DRAW, ['n' => 2, 'players' => ME]),
    ];
  }
}

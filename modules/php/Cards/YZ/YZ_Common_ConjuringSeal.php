<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_C',
      'asset' => 'ALT_CORE_B_YZ_23_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => 'Conjuring Seal',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'The Imagination shapes our reality just as our beliefs shaped the Æther.',
      'artist' => 'Khoa Viet',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Draw two cards.',
      'costHand' => 3,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(DRAW, ['n' => 2, 'players' => ME])
    ];
  }
}

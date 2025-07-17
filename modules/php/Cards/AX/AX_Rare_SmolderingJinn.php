<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_SmolderingJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_68_R2',
      'asset'  => 'ALT_CYCLONE_B_BR_68_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Smoldering Jinn"),
      'typeline' => clienttranslate("Character - Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Fire is always smoldering in the idea of the ember.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [ELEMENTAL],
      'effectDesc' => clienttranslate('{R} Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 4,
      'effectReserve' => FT::ACTION(DRAW_MANA, [])
    ];
  }
}

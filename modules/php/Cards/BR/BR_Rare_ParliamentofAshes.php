<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_ParliamentofAshes extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_81_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_81_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Parliament of Ashes"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('A place of eternal rest for the dead, and for Rune\'s Phoenix, the nest of its rebirth.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} #Draw a card.#  Characters you control are <TOUGH_CHA_P_1>. (Opponents must pay {1} to target them.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'tough' => 'universalCharacter1'
    ];
  }
}

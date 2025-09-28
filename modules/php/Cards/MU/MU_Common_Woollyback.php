<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Woollyback extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_83_C',
      'asset'  => 'ALT_CYCLONE_B_MU_83_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Woollyback"),
      'typeline' => clienttranslate("Token Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The warmth of wool and the softness of cotton candy, now together on four legs.'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('(When I leave the Expedition zone, remove me from the game.)'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'token' => true,
      'costHand' => 0,
      'costReserve' => 0,
    ];
  }
}

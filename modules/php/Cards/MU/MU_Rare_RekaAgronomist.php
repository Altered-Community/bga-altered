<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_RekaAgronomist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_91_R1',
      'asset'  => 'ALT_DUSTER_B_MU_91_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Agronomist"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"By crossing the fruits of the two world trees, we could obtain a fertile specimen."'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('#{J}# Create a <MANASEED> token in target opponent\'s Landmarks.'),
      'forest' => 5,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'ocean'],
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'targetPlayer' => OPPONENT,
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),
    ];
  }
}

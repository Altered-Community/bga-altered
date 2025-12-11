<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_RekaCaterer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_94_C',
      'asset'  => 'ALT_DUSTER_B_OR_94_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Caterer"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Happiness is always within reach, if you know how to savor it. Care for a smoothie?"'),
      'artist' => "Damian Audino",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{J} Create a <MANASEED> token in your Landmarks. (It\'s a Permanent token with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),

    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_RekaFisherman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_94_C',
      'asset'  => 'ALT_DUSTER_B_BR_94_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Fisherman"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Haha, check it out, it\'s already stuffed!"'),
      'artist' => "Victor Canton",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('{R} Create two <MANASEED> tokens in your Landmarks. (They are Permanents with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 5,
      'effectReserve' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'n' => 2,
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_RekaPeddler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_92_C',
      'asset'  => 'ALT_DUSTER_B_BR_92_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Peddler"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Keep the change!"'),
      'artist' => "Gamon Studio",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{R} I lose <FLEETING>, then create a <MANASEED> token in target opponent\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'effectReserve' => FT::SEQ(
        FT::LOOSE(ME, FLEETING),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'targetPlayer' => OPPONENT,
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
      )
    ];
  }
}

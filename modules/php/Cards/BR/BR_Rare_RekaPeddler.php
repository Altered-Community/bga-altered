<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_RekaPeddler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_92_R1',
      'asset'  => 'ALT_DUSTER_B_BR_92_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Peddler"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Keep the change!"'),
      'artist' => "Gamon Studio",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{R} #You may# create a <MANASEED> token in target opponent\'s Landmarks. #If you do,# I lose <FLEETING>.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
      'effectReserve' => FT::SEQ_OPTIONAL(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'targetPlayer' => OPPONENT,
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
        FT::LOOSE(ME, FLEETING),
      )
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Nephele extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_96_R1',
      'asset'  => 'ALT_DUSTER_B_BR_96_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Nephele"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Even the brightest day of sunshine has its clouds.'),
      'artist' => "Taras Susak",
      'extension' => 'SDU',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{J} You may pass. #If you do,# create a <MANASEED> token in #another target player\'s# Landmarks.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['mountain'],
      'effectPlayed' => FT::SEQ_OPTIONAL_MANUAL(
        FT::ACTION(END_AFTERNOON, []),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'allPlayers' => true,
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
      )
    ];
  }
}

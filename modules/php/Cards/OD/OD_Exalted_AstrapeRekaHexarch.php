<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Exalted_AstrapeRekaHexarch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_97_E',
      'asset'  => 'ALT_DUSTER_B_OR_97_E',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_EXALTED,
      'name'  => clienttranslate("Astrape, Reka Hexarch"),
      'typeline' => clienttranslate("Character - Noble"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I\'m sure the Musubi ritual will help us understand your point of view."'),
      'artist' => "Tristan Bideau",
      'extension' => 'SDU',
      'subtypes'  => [NOBLE, BUREAUCRAT],
      'effectDesc' => clienttranslate('{J} Create three <MANASEED> tokens in your Landmarks. Then, I gain 1 boost per card in your Landmarks.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 6,
      'costReserve' => 6,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'n' => 3,
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXLandmark'])
      )
    ];
  }
}

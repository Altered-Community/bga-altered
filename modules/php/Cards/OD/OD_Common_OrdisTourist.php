<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_OrdisTourist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_90_C',
      'asset'  => 'ALT_DUSTER_B_OR_90_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Ordis Tourist"),
      'typeline' => clienttranslate("Character - Citizen Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The more I visit this city, the more I love it."'),
      'artist' => "Tristan Bideau",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN, SOLDIER],
      'effectDesc' => clienttranslate('{J} If there are two or more cards in your Landmarks, I gain 1 boost.'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasControl:landmark:2', 'effect' => FT::GAIN(ME, BOOST)])
    ];
  }
}

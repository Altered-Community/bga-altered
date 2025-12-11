<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OrdisTourist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_OR_90_R1',
      'asset'  => 'ALT_DUSTER_B_OR_90_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Ordis Tourist"),
      'typeline' => clienttranslate("Character - Citizen Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"The more I visit this city, the more I love it."'),
      'artist' => "Tristan Bideau",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN, SOLDIER],
      'effectDesc' => clienttranslate('{J} I gain #1 boost per card in your Landmarks, up to a max of 3 boosts on me.#'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'ocean'],
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXLandmarkMax3'])
    ];
  }
}

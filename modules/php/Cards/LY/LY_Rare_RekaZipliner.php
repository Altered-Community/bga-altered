<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_RekaZipliner extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_88_R1',
      'asset'  => 'ALT_DUSTER_B_LY_88_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Zipliner"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The shortest distance between two points is a straight line.'),
      'artist' => "Victor Canton",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#{H} If I\'m in {O}, create a <MANASEED> token in your Landmarks.#'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isInBiome:ocean',
        'description' => clienttranslate('Create a Manaseed'),
        'effect' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
        ]),
      ]),
    ];
  }
}

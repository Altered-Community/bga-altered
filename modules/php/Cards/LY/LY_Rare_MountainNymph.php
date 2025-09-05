<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_MountainNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_70_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_70_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mountain Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From a mere pebble, she creates a sparkling jewel.'),
      'artist' => "Tristan Bideau",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {M}, create an <AEROLITH> token in #target player\'s# Landmarks.  #{R} You may move a {M} Terrain Marker from any region to my region.#'),
      'forest' => 0,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isOpponentExpeditionIn:mountain',
        'effect' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Aerolith',
          'targetLocation' => [LANDMARK],
          'allPlayers' => true
        ]),
      ]),
      'effectReserve' => FT::ACTION(MOVE_REGION_MARKER, ['markerType' => MOUNTAIN])
    ];
  }
}

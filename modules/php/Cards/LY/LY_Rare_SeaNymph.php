<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_SeaNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_68_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_68_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Sea Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From a thin trickle of water, she creates raging tides.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {O}, <SABOTAGE_LOW>.  #{R} You may move a {O} Terrain Marker from any region to my region.#'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isOpponentExpeditionIn:ocean', 'effect' => FT::SABOTAGE()]),
      'effectReserve' => FT::ACTION(MOVE_REGION_MARKER, ['markerType' => OCEAN])
    ];
  }
}

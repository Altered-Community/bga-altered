<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_ForestNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_71_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_71_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Forest Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From an innocent seed, she creates wild forests.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {V}, you may have target Character gain <FLEETING>.  #{R} You may move a {V} Terrain Marker from any region to my region.#'),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isOpponentExpeditionIn:forest',
        'effect' => FT::ACTION(TARGET, ['upTo' => true, 'effect' => FT::GAIN(EFFECT, ASLEEP)])
      ]),
      'effectReserve' => FT::ACTION(MOVE_REGION_MARKER, ['markerType' => FOREST])
    ];
  }
}

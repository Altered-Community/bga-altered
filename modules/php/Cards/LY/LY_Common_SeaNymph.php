<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_SeaNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_68_C',
      'asset'  => 'ALT_CYCLONE_B_LY_68_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Sea Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From a thin trickle of water, she creates raging tides.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {O}, <SABOTAGE_LOW>. (Discard up to one target card from a Reserve.)'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isOpponentExpeditionIn:ocean', 'effect' => FT::SABOTAGE()])
    ];
  }
}

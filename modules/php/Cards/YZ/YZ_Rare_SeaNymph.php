<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_SeaNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_68_R2',
      'asset'  => 'ALT_CYCLONE_B_LY_68_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Sea Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From a thin trickle of water, she creates raging tides.'),
      'artist' => "Nestor Papatriantafyllou",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('#{J}# If I\'m facing an Expedition in {O}, <SABOTAGE_LOW>.'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isOpponentExpeditionIn:ocean', 'effect' => FT::SABOTAGE()])

    ];
  }
}

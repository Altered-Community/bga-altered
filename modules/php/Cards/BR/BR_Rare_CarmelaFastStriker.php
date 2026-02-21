<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_CarmelaFastStriker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_111_R1',
      'asset'  => 'ALT_EOLE_B_BR_111_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Carmela, Fast Striker"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#{J}# If you control a #<COMPLETED_LOW># Feat, #I lose <FLEETING>.#'),
      'supportDesc' => clienttranslate('#{D} : Pay {1} less for the next Feat you play this turn, down to a minimum of {1}.#'),
      'supportIcon' => 'discard',
      'forest' => 4,
      'mountain' => 4,
      //VTO
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl:feat:1',
        'effect' => FT::LOOSE(ME, FLEETING),
      ]),
    ];
  }
}

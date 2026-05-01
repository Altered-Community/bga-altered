<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_CarmelaFastStriker extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_111_C',
      'asset'  => 'ALT_EOLE_B_BR_111_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Carmela, Fast Striker"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless you control a Feat. (If I would be sent to Reserve, discard me instead.)'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl:feat:1',
        'effect' => null,
        'oppositeEffect' => FT::GAIN(ME, FLEETING),
      ]),
    ];
  }
}

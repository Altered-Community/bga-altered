<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_CheshireCat extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_91_C',
      'asset'  => 'ALT_DUSTER_B_LY_91_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Cheshire Cat"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"We\'re all mad here."'),
      'artist' => "Taras Susak",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL],
      'effectDesc' => clienttranslate('{H} If I\'m <IN_CONTACT>, you may have target Character switch Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition. I\'m In Contact if another player\'s Expedition is in my region.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isInContact',
        'effect' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])]),
      ])
    ];
  }
}

<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_ForestNymph extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_71_C',
      'asset'  => 'ALT_CYCLONE_B_LY_71_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Forest Nymph"),
      'typeline' => clienttranslate("Character - Fairy"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From an innocent seed, she creates wild forests.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [FAIRY],
      'effectDesc' => clienttranslate('{H} If I\'m facing an Expedition in {V}, you may have target Character gain <FLEETING>. (If it would be sent to Reserve, discard it instead.)'),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isOpponentExpeditionIn:forest',
        'effect' => FT::ACTION(TARGET, ['upTo' => true, 'effect' => FT::GAIN(EFFECT, FLEETING)])
      ])
    ];
  }
}

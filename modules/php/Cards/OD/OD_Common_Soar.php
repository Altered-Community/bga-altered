<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Soar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_79_C',
      'asset'  => 'ALT_CYCLONE_B_OR_79_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Soar"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A Zephyr feather gives the Ordis the ability to fly.'),
      'artist' => "Huo Miao Studio",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
      'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
      'supportIcon' => 'discard',
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])]),
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
    ];
  }
}

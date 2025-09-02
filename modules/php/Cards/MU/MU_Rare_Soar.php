<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Soar extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_79_R2',
      'asset'  => 'ALT_CYCLONE_B_OR_79_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Soar"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('A Zephyr feather gives the Ordis the ability to fly.'),
      'artist' => "Huo Miao Studio",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('Target Expedition <ASCENDS>.  #You may give 1 boost to target Character in an Ascended Expedition.#'),
      'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost.'),
      'supportIcon' => 'discard',
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])]),
        FT::ACTION(TARGET, ['ascendedOnly' => true, 'upTo' => true, 'effect' => FT::GAIN(EFFECT, BOOST)])
      ),
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
    ];
  }
}

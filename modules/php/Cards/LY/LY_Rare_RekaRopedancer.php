<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_RekaRopedancer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_110_R1',
      'asset'  => 'ALT_EOLE_B_LY_110_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Ropedancer"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('She knows the ropes!'),
      'artist' => "Saeed Jalabi",
      'extension' => 'ROC',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#{J} Target Character with a {D} ability in play or in Reserve gains one boost.#'),
      'supportDesc' => clienttranslate('{D} : The next Character you play this turn gains 1 boost and <ASLEEP>.'),
      'supportIcon' => 'discard',
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1BoostAndAsleep']),
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'targetLocation' => [STORM_LEFT, STORM_RIGHT, RESERVE],
        'targetPlayer' => ME,
        'hasEffects' => ['Support'],
        'effect' => FT::GAIN(TARGET, BOOST),
      ]),
    ];
  }
}

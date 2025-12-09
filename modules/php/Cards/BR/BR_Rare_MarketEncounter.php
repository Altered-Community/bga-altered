<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_MarketEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_99_R1',
      'asset'  => 'ALT_DUSTER_B_BR_99_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Market Encounter"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Your catch of the day deserves a Manaseed!"'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('#Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).#'),
      'supportDesc' => clienttranslate('{D} : The next Character played from your hand this turn activates one of its {r} abilities.'),
      'supportIcon' => 'discard',
      'costHand' => 3,
      'costReserve' => 4,
      'changedStats' => ['costHand', 'costReserve'],
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'limit' => 1, 'effect' => RESERVE],
      ]),
      'effectPlayed' => FT::ACTION(DRAW_MANA, [])
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_MarketEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_99_C',
      'asset'  => 'ALT_DUSTER_B_BR_99_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Market Encounter"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Your catch of the day deserves a Manaseed!"'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('Create a <MANASEED> token in your Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'supportDesc' => clienttranslate('{D} : The next Character played from your hand this turn activates one of its {r} abilities.'),
      'supportIcon' => 'discard',
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'NE_Common_Manaseed',
        'targetLocation' => [LANDMARK],
      ]),
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, [
        'effect' => 'triggerEffectOfNextCharacter',
        'args' => ['type' => CHARACTER, 'from' => HAND, 'effect' => RESERVE],
      ])
    ];
  }
}

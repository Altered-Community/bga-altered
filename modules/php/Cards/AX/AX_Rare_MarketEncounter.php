<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_MarketEncounter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_99_R2',
      'asset'  => 'ALT_DUSTER_B_BR_99_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Market Encounter"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('"Your catch of the day deserves a Manaseed!"'),
      'artist' => "Justice Wong",
      'extension' => 'SDU',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('Create a <MANASEED> token in your Landmarks.'),
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

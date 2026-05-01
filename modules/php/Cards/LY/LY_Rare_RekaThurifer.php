<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_RekaThurifer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_116_R1',
      'asset'  => 'ALT_EOLE_B_LY_116_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Thurifer"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Through drifting incense, we purge the darkness within.'),
      'artist' => "DOBA",
      'extension' => 'ROC',
      'subtypes'  => [CITIZEN],
      'effectDesc' => clienttranslate('#Play me for {1} less if another card in your Expeditions or your Reserve has a {D} ability.#  {H} $<SABOTAGE>.'),
      'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}. (Discard me from Reserve to do this.)'),
      'supportIcon' => 'discard',
      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costReserve'],
      'dynamicCostReduction' => '1:hasOtherSupportCardInReserveOrExpeditions',
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1, 'minimum' => 1]],
      ],
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_SternSentinel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_117_R1',
      'asset'  => 'ALT_EOLE_B_BR_117_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Stern Sentinel"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
      'extension' => 'ROC',
      'subtypes'  => [SOLDIER],
      'effectDesc' => clienttranslate('{H} #If you control a Feat, <SABOTAGE_LOW>.# Otherwise, <SABOTAGE_LOW> a card with Reserve Cost {2} or less.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['ocean'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'hasControl:feat:1',
        'effect' => FT::SABOTAGE(),
        'oppositeEffect' => FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
          'targetLocation' => [RESERVE],
          'maxReserveCost' => 2,
          'upTo' => true,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ]),
    ];
  }
}

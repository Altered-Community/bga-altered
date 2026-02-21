<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SternSentinel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_117_C',
      'asset'  => 'ALT_EOLE_B_BR_117_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Stern Sentinel"),
      'typeline' => clienttranslate("Character - Soldier"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "DOBA",
      'extension' => 'ROC',
      'subtypes'  => [SOLDIER],
      'effectDesc' => clienttranslate('{H} <SABOTAGE> a card with Reserve Cost {2} or less. (You may discard one such card from any Reserve.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'maxReserveCost' => 2,
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}

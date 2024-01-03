<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_IssunBoshi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_05_C',
      'asset' => 'ALT_CORE_B_BR_05_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Issun-Boshi'),
      'type' => CHARACTER,
      'subtype' => [ADVENTURER],
      'supportDesc' => clienttranslate(
        '{D} : The next Character you play this turn gains 1 boost. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 1,
      'costReserve' => 1,
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
    ];
  }
}

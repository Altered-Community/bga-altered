<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_15_C',
      'asset' => 'ALT_CORE_B_BR_15_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Haven Bouncer'),
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate('{H} $<SABOTAGE>.  {R} I gain 1 boost.'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'flavorText' => clienttranslate('Only the bravest can enter Haven.'),
      'artist' => 'Edward Cheekokseang',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
      'effectReserve' => FT::GAIN($this, BOOST),
    ];
  }
}

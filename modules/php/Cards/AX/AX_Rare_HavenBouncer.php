<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;


class AX_Rare_HavenBouncer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_15_R2',
      'asset' => 'ALT_CORE_B_BR_15_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Haven Bouncer',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => 'Only the bravest can enter Haven.',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [SOLDIER],
      'effectDesc' => '{H} $<SABOTAGE>.  {R} I gain #2 boosts#.',
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
      'effectReserve' => FT::GAIN($this, BOOST, 2),
    ];
  }
}

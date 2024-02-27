<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_HavenWarrior extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_17_R2',
      'asset' => 'ALT_CORE_B_BR_17_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Haven Warrior',
      'typeline' => 'Character - Soldier',
      'type' => CHARACTER,
      'flavorText' => 'We\'ve all lived through some things. But she\'s been through worse.',
      'artist' => 'Edward Cheekokseang',
      'subtypes' => [SOLDIER],
      'supportDesc' => '#{D} : The next Character you play this turn gains 1 boost.# (Discard me from Reserve to do this.)',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['mountain'],
      'supportIcon' => 'discard',
      'effectSupport' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost']),
    ];
  }
}

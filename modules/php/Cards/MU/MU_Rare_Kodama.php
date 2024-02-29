<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Kodama extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_09_R1',
      'asset' => 'ALT_CORE_B_MU_09_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Kodama',
      'typeline' => 'Character - Spirit Plant',
      'type' => CHARACTER,
      'flavorText' => 'There\'s no greater blessing for a tree than to offer a home for a Kodama.',
      'artist' => 'Ba Vo',
      'subtypes' => [SPIRIT, PLANT],
      'effectDesc' => '{H} I gain $<ASLEEP>.',
      'supportDesc' =>
      '#{D} : Target Character with Hand Cost {3} or less gains <ANCHORED>.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::GAIN($this, ASLEEP),
      'supportIcon' => 'discard',
      'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}

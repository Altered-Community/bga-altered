<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_C',
      'asset' => 'ALT_CORE_B_MU_29_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Harvest',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'The thankful receiver bears a plentiful harvest.',
      'artist' => 'Ba Vo',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$<RESUPPLY>.',
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(RESUPPLY, [])
    ];
  }
}

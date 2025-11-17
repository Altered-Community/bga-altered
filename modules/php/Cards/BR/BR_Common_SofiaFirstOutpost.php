<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_SofiaFirstOutpost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_P_BR_64_C',
      'asset' => 'ALT_BISE_P_BR_64_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sofia, First Outpost'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK, CONSTRUCTION],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>.  The Support abilities of cards in Reserve can give them 1 more counter than their maximum.("Up to a max. of X" restrictions become "up to a max of X+1".)'),
      'typeline' => clienttranslate('Landmark Permanent - Construction'),
      'flavorText' => '',
      'artist' => 'Tristan Bideau',
      'extension' => 'WTFM',


      'costHand' => 2,
      'costReserve' => 2,

      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'reserveAdd' => 1
    ];
  }
}

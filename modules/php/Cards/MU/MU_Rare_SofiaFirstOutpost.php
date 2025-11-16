<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class MU_Rare_SofiaFirstOutpost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_BISE_P_BR_64_R2',
      'asset' => 'ALT_BISE_P_BR_64_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sofia, First Outpost'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK, CONSTRUCTION],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>.  The Support abilities of cards in Reserve can give them #counters beyond their maximum#. (Ignore "up to a max." restrictions.)'),
      'typeline' => clienttranslate('Landmark Permanent - Construction'),
      'flavorText' => '',
      'artist' => 'Tristan Bideau',
      'extension' => 'WTFM',
      'changedStats' => ['costHand', 'costReserve'],

      'costHand' => 3,
      'costReserve' => 3,

      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'reserveAdd' => 99
    ];
  }
}

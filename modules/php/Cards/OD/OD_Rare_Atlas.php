<?php

namespace ALT\Cards\OD;

class OD_Rare_Atlas extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_20_R2',
      'asset' => 'ALT_CORE_B_BR_20_R',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Atlas',
      'typeline' => 'Character - Titan',
      'type' => CHARACTER,
      'flavorText' => 'Not even the weight of the sky could make him buckle.',
      'artist' => 'Matteo Spirito',
      'subtypes' => [TITAN],
      'effectDesc' => '$<GIGANTIC>.  #Tokens you control have <GIGANTIC>.#',
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['forest', 'mountain', 'ocean'],
      'gigantic' => true,
      'dynamicGigantic' => 'universalGiganticToken'
    ];
  }
}

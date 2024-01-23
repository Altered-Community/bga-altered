<?php

namespace ALT\Cards\OD;

class OD_Common_TheMonolithOrdisBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_28_C',
      'asset' => 'ALT_CORE_B_OR_28_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Monolith, Ordis Bastion'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('When a Character joins your Expeditions, it gains 1 boost.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

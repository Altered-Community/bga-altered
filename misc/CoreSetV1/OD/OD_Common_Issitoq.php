<?php

namespace ALT\Cards\OD;

class OD_Common_Issitoq extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_19_C',
      'asset' => 'ALT_CORE_B_OR_19_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Issitoq'),
      'type' => CHARACTER,
      'subtype' => BUREAUCRAT,
      'effectDesc' => clienttranslate(
        'Characters in the opponent\'s Expedition facing me don\'t trigger their {J}, {M} and {S} abilities.'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

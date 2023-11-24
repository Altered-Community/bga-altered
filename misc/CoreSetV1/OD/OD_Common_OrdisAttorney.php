<?php

namespace ALT\Cards\OD;

class OD_Common_OrdisAttorney extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_16_C',
      'asset' => 'ALT_CORE_B_OR_16_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Attorney'),
      'type' => CHARACTER,
      'subtype' => BUREAUCRAT,
      'effectDesc' => clienttranslate('When my Expedition doesn\'t advance during Dusk — Draw a card.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php

namespace ALT\Cards\OD;

class OD_Common_Thoth extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_22_C',
      'asset' => 'ALT_CORE_B_OR_22_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Thoth'),
      'type' => CHARACTER,
      'subtype' => BUREAUCRAT,
      'effectDesc' => clienttranslate(
        'When my Expedition doesn\'t advance during Dusk — Create a [ORDIS_RECRUIT] Soldier token.  '
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

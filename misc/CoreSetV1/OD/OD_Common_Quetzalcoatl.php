<?php

namespace ALT\Cards\OD;

class OD_Common_Quetzalcoatl extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_18_C',
      'asset' => 'ALT_CORE_B_OR_18_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Quetzalcoatl'),
      'type' => CHARACTER,
      'subtype' => BUREAUCRAT,
      'effectDesc' => clienttranslate(
        'Whenever an opponent draws one or more cards or activates [RESUPPLY] — Create a [ORDIS_RECRUIT] Soldier token.  '
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

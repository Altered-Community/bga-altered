<?php

namespace ALT\Cards\AX;

class AX_Common_FoundryMechanic extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_07_C',
      'asset' => 'ALT_CORE_B_AX_07_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Foundry Mechanic'),
      'type' => CHARACTER,
      'subtype' => ENGINEER,
      'supportDesc' => clienttranslate(
        '{D} : The next Permanent you play this turn costs {1} less. (Discard me from your Reserve to activate this effect)  '
      ),
      'forest' => 0,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

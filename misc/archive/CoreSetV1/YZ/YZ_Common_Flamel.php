<?php

namespace ALT\Cards\YZ;

class YZ_Common_Flamel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_14_C',
      'asset' => 'ALT_CORE_B_YZ_14_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Flamel'),
      'type' => CHARACTER,
      'subtype' => MAGE,
      'effectDesc' => clienttranslate('{M} You may put a Spell from your Reserve into your hand.'),
      'supportDesc' => clienttranslate(
        '{D} : The next Spell you play this turn costs {1} less. (Discard me from your Reserve to activate this effect)'
      ),
      'forest' => 4,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

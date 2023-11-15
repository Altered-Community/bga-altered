<?php
namespace ALT\Cards\MU;

class MU_Common_Dracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_15_C',
      'asset' => 'ALT_CORE_B_MU_15_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Dracaena'),
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('{J} I become $[ANCHORED].  At Dawn — I gain 1 boost.  '),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

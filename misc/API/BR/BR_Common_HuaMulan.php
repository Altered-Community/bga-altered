<?php
namespace ALT\Cards\BR;

class BR_Common_HuaMulan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_12_C',
      'asset' => 'ALT_CORE_B_BR_12_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hua Mulan'),
      'typeline' => clienttranslate('Character - Adventurer'),
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => clienttranslate('{S} I lose [[Fleeting]].'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

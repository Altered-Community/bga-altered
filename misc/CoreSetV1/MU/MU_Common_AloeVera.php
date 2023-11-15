<?php
namespace ALT\Cards\MU;

class MU_Common_AloeVera extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_16_C',
      'asset' => 'ALT_CORE_B_MU_16_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Aloe Vera'),
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('At Dawn — $[RESUPPLY].  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

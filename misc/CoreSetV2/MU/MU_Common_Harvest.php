<?php
namespace ALT\Cards\MU;

class MU_Common_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_C',
      'asset' => 'ALT_CORE_B_MU_29_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Harvest'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('$[RESUPPLY].'),
      'costHand' => 1,
      'costReserve' => 2,
    ];
  }
}

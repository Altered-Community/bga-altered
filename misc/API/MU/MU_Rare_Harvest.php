<?php
namespace ALT\Cards\MU;

class MU_Rare_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_R1',
      'asset' => 'ALT_CORE_B_MU_29_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Harvest'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('[Resupply], then [Resupply] again. (Put the top card of your deck in Reserve.)'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

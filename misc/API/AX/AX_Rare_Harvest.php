<?php
namespace ALT\Cards\AX;

class AX_Rare_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_R2',
      'asset' => 'ALT_CORE_B_MU_29_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Harvest'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('[Resupply]. (Put the top card of your deck in your Reserve.)'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

<?php
namespace ALT\Cards\OD;

class OD_Rare_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_R2',
      'asset' => 'ALT_CORE_B_YZ_23_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Conjuring Seal'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('Draw two cards.'),
      'costHand' => 3,
      'costReserve' => 5,
    ];
  }
}

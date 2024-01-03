<?php
namespace ALT\Cards\YZ;

class YZ_Rare_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_R1',
      'asset' => 'ALT_CORE_B_YZ_23_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Conjuring Seal'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('Draw three cards.'),
      'costHand' => 4,
      'costReserve' => 5,
    ];
  }
}

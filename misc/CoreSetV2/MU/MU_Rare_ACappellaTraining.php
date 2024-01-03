<?php
namespace ALT\Cards\MU;

class MU_Rare_ACappellaTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_22_R2',
      'asset' => 'ALT_CORE_B_LY_22_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('A Cappella Training'),
      'typeline' => clienttranslate('Spell - Song'),
      'type' => SPELL,
      'subtypes' => [SONG],
      'effectDesc' => clienttranslate('Target Character gains $[FLEETING_CHAR].'),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

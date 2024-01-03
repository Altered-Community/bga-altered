<?php
namespace ALT\Cards\MU;

class MU_Common_Nurture extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_27_C',
      'asset' => 'ALT_CORE_B_MU_27_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Nurture'),
      'typeline' => clienttranslate('Spell - Boon'),
      'type' => SPELL,
      'subtypes' => [BOON],
      'effectDesc' => clienttranslate('Up to two target Characters each gain 1 boost$[BB].'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

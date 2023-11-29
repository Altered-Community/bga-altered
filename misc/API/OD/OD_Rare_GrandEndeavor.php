<?php
namespace ALT\Cards\OD;

class OD_Rare_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_R1',
      'asset' => 'ALT_CORE_B_OR_29_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Grand Endeavor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '[Tough 2].  At Night — Target Expedition moves forward. (Your opponent\'s Spells and abilities that target me cost {2} more.)'
      ),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

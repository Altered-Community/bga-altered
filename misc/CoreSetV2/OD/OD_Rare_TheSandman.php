<?php
namespace ALT\Cards\OD;

class OD_Rare_TheSandman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_15_R2',
      'asset' => 'ALT_CORE_B_LY_15_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Sandman'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('{H} Up to one target Character gains $[ASLEEP]. #You may have it gain 2 boosts.#'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
    ];
  }
}

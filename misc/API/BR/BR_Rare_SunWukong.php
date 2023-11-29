<?php
namespace ALT\Cards\BR;

class BR_Rare_SunWukong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_18_R1',
      'asset' => 'ALT_CORE_B_BR_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sun Wukong'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{S} I gain 2 boosts and I lose [[Fleeting]].'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

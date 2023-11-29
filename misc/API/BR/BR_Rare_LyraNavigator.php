<?php
namespace ALT\Cards\BR;

class BR_Rare_LyraNavigator extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_06_R2',
      'asset' => 'ALT_CORE_B_LY_06_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Lyra Navigator'),
      'typeline' => clienttranslate('Character - Citizen'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

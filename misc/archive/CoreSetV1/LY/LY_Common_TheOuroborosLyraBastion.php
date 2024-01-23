<?php

namespace ALT\Cards\LY;

class LY_Common_TheOuroborosLyraBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_30_C',
      'asset' => 'ALT_CORE_B_LY_30_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Ouroboros, Lyra Bastion'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('If you should roll a die, roll an additional one. Ignore the result of your choice.'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

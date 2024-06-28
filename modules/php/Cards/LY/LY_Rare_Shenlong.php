<?php

namespace ALT\Cards\LY;

class LY_Rare_Shenlong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_22_R2',
      'asset' => 'ALT_CORE_B_BR_22_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Shenlong',
      'typeline' => 'Character - Deity Dragon',
      'type' => CHARACTER,
      'flavorText' => 'Be careful what you wish for. There are challenges that even the Bravos prefer to avoid.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DEITY, DRAGON],
      'forest' => 8,
      'mountain' => 8,
      'ocean' => 8,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

<?php

namespace ALT\Cards\BR;

class BR_Rare_Shenlong extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_22_R1',
      'asset' => 'ALT_CORE_B_BR_22_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Shenlong'),
      'typeline' => clienttranslate('Character - Dragon Deity'),
      'type' => CHARACTER,
      'subtypes' => [DRAGON, DEITY],
      'effectDesc' => clienttranslate('#$[TOUGH_1].#'),
      'forest' => 9,
      'mountain' => 9,
      'ocean' => 9,
      'costHand' => 6,
      'costReserve' => 6,
      'changedStats' => ['forest', 'mountain', 'ocean'],
      'tough' => 1,
      'flavorText' => clienttranslate('Be careful what you wish for. There are challenges that even the Bravos prefer to avoid.'),
      'artist' => 'HuoMiao Studio',
    ];
  }
}

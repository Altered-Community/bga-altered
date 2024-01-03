<?php

namespace ALT\Cards\MU;

class MU_Common_Cernunnos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_14_C',
      'asset' => 'ALT_CORE_B_MU_14_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Cernunnos'),
      'type' => CHARACTER,
      'subtypes' => [DRUID, DEITY],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 3,
      'typeline' => clienttranslate('Character - Druid Deity'),
    ];
  }
}

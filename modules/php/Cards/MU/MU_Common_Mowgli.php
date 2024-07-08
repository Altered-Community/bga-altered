<?php

namespace ALT\Cards\MU;

class MU_Common_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_07_C',
      'asset' => 'ALT_CORE_B_MU_07_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mowgli'),
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Wake up, you lazy furball!"'),
      'artist' => 'Ba Vo',
      'subtypes' => [DRUID],
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}

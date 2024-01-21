<?php

namespace ALT\Cards\MU;

class MU_Common_Inari extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_11_C',
      'asset' => 'ALT_CORE_B_MU_11_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Inari'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'typeline' => clienttranslate('Character - Deity'),
      'flavorText' => clienttranslate(
        'Harmony may bloom from a single act of kindness, as a rice field may sprout from a single grain of rice. '
      ),
      'artist' => 'Matteo Spirito',
    ];
  }
}

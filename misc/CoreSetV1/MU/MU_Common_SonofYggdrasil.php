<?php

namespace ALT\Cards\MU;

class MU_Common_SonofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_21_C',
      'asset' => 'ALT_CORE_B_MU_21_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Son of Yggdrasil'),
      'type' => CHARACTER,
      'subtype' => PLANT,
      'effectDesc' => clienttranslate('$[GIGANTIC].  '),
      'forest' => 6,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

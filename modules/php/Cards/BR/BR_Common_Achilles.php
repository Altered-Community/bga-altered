<?php

namespace ALT\Cards\BR;

class BR_Common_Achilles extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_21_C',
      'asset' => 'ALT_CORE_B_BR_21_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Achilles'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('$<TOUGH_1>.'),
      'typeline' => clienttranslate('Character - Soldier'),
      'flavorText' => clienttranslate('"Many things lie between us—shadowy mountains and sounding sea."'),
      'artist' => 'Taras Susak',

      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,

      'tough' => 1,
    ];
  }
}

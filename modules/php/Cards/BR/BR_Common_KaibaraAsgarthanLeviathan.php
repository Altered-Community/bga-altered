<?php

namespace ALT\Cards\BR;

class BR_Common_KaibaraAsgarthanLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_24_C',
      'asset' => 'ALT_CORE_B_BR_24_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kaibara, Asgarthan Leviathan'),
      'type' => CHARACTER,
      'subtypes' => [LEVIATHAN],
      'effectDesc' => clienttranslate(
        '$<GIGANTIC>.  $<TOUGH_X>, where X is the number of regions between your Hero and Companion. (If they are adjacent, X equals 0.)'
      ),
      'typeline' => clienttranslate('Character - Leviathan'),
      'flavorText' => clienttranslate('For hundreds of years, Kaibara has protected Asagartha.'),
      'artist' => 'Fahmi Fauzi',

      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 8,
      'costReserve' => 8,

      'gigantic' => true,
      'dynamicTough' => 'region',
    ];
  }
}

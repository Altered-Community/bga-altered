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
      'subtype' => LEVIATHAN,
      'effectDesc' => clienttranslate(
        '$[GIGANTIC].  $[TOUGH_X], X being the numbers of regions separating your Hero and Companion.'
      ),
      'forest' => 6,
      'mountain' => 6,
      'ocean' => 6,
      'costHand' => 8,
      'costReserve' => 8,

      'gigantic' => true,
      'dynamicTough' => 'region'
    ];
  }
}

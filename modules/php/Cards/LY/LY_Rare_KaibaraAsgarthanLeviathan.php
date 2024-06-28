<?php

namespace ALT\Cards\LY;

class LY_Rare_KaibaraAsgarthanLeviathan extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_24_R2',
      'asset' => 'ALT_CORE_B_BR_24_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Kaibara, Asgarthan Leviathan',
      'typeline' => 'Character - Leviathan',
      'type' => CHARACTER,
      'flavorText' => 'For hundreds of years, Kaibara has protected Asagartha.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [LEVIATHAN],
      'effectDesc' =>
      '$<GIGANTIC>.  $<TOUGH_X>, where X is the number of regions between your Hero and Companion. (If they are adjacent, X equals 0.)',
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

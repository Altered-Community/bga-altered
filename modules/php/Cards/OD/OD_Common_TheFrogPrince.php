<?php

namespace ALT\Cards\OD;

class OD_Common_TheFrogPrince extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_09_C',
      'asset' => 'ALT_CORE_B_OR_09_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('The Frog Prince'),
      'type' => CHARACTER,
      'subtypes' => [BUREAUCRAT, NOBLE],
      'typeline' => clienttranslate('Character - Bureaucrat Noble'),
      'flavorText' => clienttranslate("Thankfully, he doesn't seal his contracts with a kiss."),
      'artist' => 'Gaga Zhou',

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

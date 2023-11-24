<?php

namespace ALT\Cards\LY;

class LY_Common_AmahleAsgarthanOutcast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_19_C',
      'asset' => 'ALT_CORE_B_LY_19_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Amahle, Asgarthan Outcast'),
      'type' => CHARACTER,
      'subtype' => DIVINITY,
      'effectDesc' => clienttranslate('{J} You may discard a card from your Reserve to Draw a card.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

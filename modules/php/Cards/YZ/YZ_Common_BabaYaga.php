<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_BabaYaga extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_11_C',
      'asset' => 'ALT_CORE_B_YZ_11_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Baba Yaga'),
      'typeline' => clienttranslate('Character - Mage'),
      'type' => CHARACTER,
      'subtypes' => [MAGE],
      'effectDesc' => clienttranslate('{H} Draw a card.'),
      'flavorText' => clienttranslate('Help or harm? Only the card will tell.'),
      'artist' => 'Atanas Lozanski',

      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(DRAW, ['players' => ME]),
    ];
  }
}

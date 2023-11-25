<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_ALTKadigiranAlchemist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_12_R1',
      'asset' => 'ALT_CORE_B_YZ_12_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('ALT Kadigiran Alchemist'),
      'type' => CHARACTER,
      'subtype' => [MAGE],
      'effectDesc' => clienttranslate('{M} I gain #3# boosts.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::GAIN($this, BOOST, 3),
    ];
  }
}

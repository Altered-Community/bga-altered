<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Offyougo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_21_C',
      'asset' => 'ALT_CORE_B_YZ_21_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Off you go!'),
      'type' => SPELL,
      'subtype' => [DISRUPTION],
      'effectDesc' => clienttranslate('Send to Reserve target Character of hand cost {3} or less.  '),
      'costHand' => 2,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::DISCARD_TO_RESERVE()]),
    ];
  }
}

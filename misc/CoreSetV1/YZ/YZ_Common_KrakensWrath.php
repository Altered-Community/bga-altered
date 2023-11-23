<?php

namespace ALT\Cards\YZ;

class YZ_Common_KrakensWrath extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_26_C',
      'asset' => 'ALT_CORE_B_YZ_26_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate("Kraken's Wrath"),
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Send to Reserve up to 3 Characters with a cumulated hand cost of {5} or less.  '
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

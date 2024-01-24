<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Alice extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_13_C',
      'asset' => 'ALT_CORE_B_YZ_13_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Alice'),
      'type' => CHARACTER,
      'subtypes' => [CITIZEN],
      'supportDesc' => clienttranslate('{D} : [AFTER_YOU]. (Discard me from Reserve to do this.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'effectSupport' => FT::ACTION(AFTER_YOU, []),
      'typeline' => clienttranslate('Character - Citizen'),
      'flavorText' => clienttranslate("\"One good turn deserves another.\""),
      'artist' => 'Taras Susak',
    ];
  }
}

<?php

namespace ALT\Cards\OD;

class OD_Common_TeamworkTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_24_C',
      'asset' => 'ALT_CORE_B_OR_24_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Teamwork Training'),
      'type' => SPELL,
      'subtype' => MANEUVER,
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Send to Reserve target Character of hand cost {X} or less, where X is the number of Characters in your Expeditions.  '
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

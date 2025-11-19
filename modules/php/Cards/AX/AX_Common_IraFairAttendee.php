<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_IraFairAttendee extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_88_C',
      'asset'  => 'ALT_DUSTER_B_AX_88_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Ira, Fair Attendee"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"One day, son, you\'ll show off your own creations here." — Della'),
      'artist' => "Tristan Bideau",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

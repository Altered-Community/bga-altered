<?php

namespace ALT\Cards\OD;

class OD_Common_OrdisRecruit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_32_C',
      'asset' => 'ALT_CORE_B_OR_32_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ordis Recruit'),
      'type' => TOKEN,
      'subtype' => [SOLDIER],
      'effectDesc' => clienttranslate('I am a token.  (When I leave the Expedition zone — Discard me).'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'token' => true,
      'costReserve' => 0,
      'costHand' => 0,
    ];
  }
}

<?php

namespace ALT\Cards\BR;

class BR_Common_HelpingHand extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_25_C',
      'asset' => 'ALT_CORE_B_BR_25_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Helping Hand'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('Target Character gains 1 boost and loses [FLEETING_CHAR].  '),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

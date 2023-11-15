<?php
namespace ALT\Cards\BR;

class BR_Common_Booda extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_31_C',
      'asset' => 'ALT_CORE_B_BR_31_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Booda'),
      'type' => TOKEN,
      'subtype' => CAT,
      'effectDesc' => clienttranslate('I am a token.  (When I leave the Expedition zone — Discard me).  '),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
    ];
  }
}

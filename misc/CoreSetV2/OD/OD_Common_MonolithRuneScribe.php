<?php
namespace ALT\Cards\OD;

class OD_Common_MonolithRuneScribe extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_07_C',
      'asset' => 'ALT_CORE_B_OR_07_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Monolith Rune-Scribe'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'subtypes' => [SCHOLAR],
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

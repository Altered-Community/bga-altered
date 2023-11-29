<?php
namespace ALT\Cards\OD;

class OD_Rare_MonolithRuneScribe extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_07_R1',
      'asset' => 'ALT_CORE_B_OR_07_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Monolith Rune-Scribe'),
      'typeline' => clienttranslate('Character - Scholar'),
      'type' => CHARACTER,
      'subtypes' => [SCHOLAR],
      'effectDesc' => clienttranslate('{M} If you control a token, [Resupply]. (Put the top card of your deck in your Reserve.)'),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

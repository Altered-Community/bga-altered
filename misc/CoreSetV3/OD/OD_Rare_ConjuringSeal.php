<?php
namespace ALT\Cards\OD;

class OD_Rare_ConjuringSeal extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_23_R2',
      'asset' => 'ALT_CORE_B_YZ_23_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Conjuring Seal',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'The Imagination shapes our reality just as our beliefs shaped the Æther.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [CONJURATION],
      'effectDesc' => 'Draw two cards.',
      'costHand' => 3,
      'costReserve' => 5,
    ];
  }
}

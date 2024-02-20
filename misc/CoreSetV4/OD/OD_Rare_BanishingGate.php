<?php
namespace ALT\Cards\OD;

class OD_Rare_BanishingGate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_24_R2',
      'asset' => 'ALT_CORE_B_YZ_24_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Banishing Gate',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Let me walk you to the door.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Discard target Character or Permanent.',
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

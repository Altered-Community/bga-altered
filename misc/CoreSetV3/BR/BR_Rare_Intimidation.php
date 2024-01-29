<?php
namespace ALT\Cards\BR;

class BR_Rare_Intimidation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_28_R1',
      'asset' => 'ALT_CORE_B_BR_28_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Intimidation',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'The terrible beast shrank and cowered before the might of the Bravos.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Return target Character or Permanent with Hand Cost #{5}# or less to its owner\'s hand.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

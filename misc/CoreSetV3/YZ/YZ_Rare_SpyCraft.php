<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_22_R1',
      'asset' => 'ALT_CORE_B_YZ_22_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Spy Craft',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'This message will self-destruct in five seconds.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<SABOTAGE>, then $<RESUPPLY>.',
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
    ];
  }
}

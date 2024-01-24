<?php
namespace ALT\Cards\LY;

class LY_Rare_SpyCraft extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_22_R2',
      'asset' => 'ALT_CORE_B_YZ_22_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Spy Craft',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'This message will self-destruct in five seconds.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$[FLEETING].  $[SABOTAGE], then $[RESUPPLY].',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

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
      'name' => clienttranslate('Spy Craft'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('$[SABOTAGE], then $[RESUPPLY].'),
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Rare_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_R1',
      'asset' => 'ALT_CORE_B_MU_29_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Harvest',
      'typeline' => 'Spell - Conjuration',
      'type' => SPELL,
      'flavorText' => 'The thankful receiver bears a plentiful harvest.',
      'artist' => 'Ba Vo',
      'subtypes' => [CONJURATION],
      'effectDesc' => '$<RESUPPLY>, #then <RESUPPLY_LOW> again#.',
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand'],
    ];
  }
}

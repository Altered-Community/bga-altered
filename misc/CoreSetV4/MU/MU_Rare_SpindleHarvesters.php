<?php
namespace ALT\Cards\MU;

class MU_Rare_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_R1',
      'asset' => 'ALT_CORE_B_MU_06_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Spindle Harvesters',
      'typeline' => 'Character - Animal Plant',
      'type' => CHARACTER,
      'flavorText' => 'Some say the harvesters are the caretakers of the world-trees.',
      'artist' => 'Ba Vo',
      'subtypes' => [ANIMAL, PLANT],
      'effectDesc' => '{J} I gain $<ANCHORED>.  #At Noon, if I have 2 or more boosts — $<RESUPPLY>.#',
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

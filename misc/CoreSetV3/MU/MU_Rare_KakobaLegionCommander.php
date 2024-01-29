<?php
namespace ALT\Cards\MU;

class MU_Rare_KakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_15_R2',
      'asset' => 'ALT_CORE_B_OR_15_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Kakoba, Legion Commander',
      'typeline' => 'Character - Soldier Noble',
      'type' => CHARACTER,
      'flavorText' => 'The general who became a scholar; the scholar who became a senator.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [SOLDIER, NOBLE],
      'effectDesc' => '{J} If you control three or more other Characters, I gain #3 boosts$<BB>#.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Rare_Verdantback extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_19_R1',
      'asset' => 'ALT_CORE_B_MU_19_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Verdantback',
      'typeline' => 'Character - Plant Animal',
      'type' => CHARACTER,
      'flavorText' => 'Slow and steady wins the race.',
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT, ANIMAL],
      'effectDesc' => 'I have $<DEFENDER> unless you control two or more other Plants.',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
    ];
  }
}

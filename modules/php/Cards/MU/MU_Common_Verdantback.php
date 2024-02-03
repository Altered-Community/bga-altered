<?php

namespace ALT\Cards\MU;

class MU_Common_Verdantback extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_19_C',
      'asset' => 'ALT_CORE_B_MU_19_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Verdantback',
      'typeline' => 'Character - Plant Animal',
      'type' => CHARACTER,
      'flavorText' => 'Slow and steady wins the race.',
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT, ANIMAL],
      'effectDesc' => 'I have $<DEFENDER> unless you control two or more other Plants.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 6,
      'costHand' => 4,
      'costReserve' => 4,
      'dynamicDefender' => '2OtherPlants'
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Rare_DaughterofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_12_R1',
      'asset' => 'ALT_CORE_B_MU_12_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Daughter of Yggdrasil',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => 'The children of Yggdrasil now take care of the world trees.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [PLANT],
      'effectDesc' => '{H} #Each player# draws a card.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_DaughterofYggdrasil extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_12_R2',
      'asset' => 'ALT_CORE_B_MU_12_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Daughter of Yggdrasil',
      'typeline' => 'Character - Plant',
      'type' => CHARACTER,
      'flavorText' => 'The children of Yggdrasil now take care of the world trees.',
      'artist' => 'Nestor Papatriantafyllou',
      'subtypes' => [PLANT],
      'effectDesc' => '{H} Target opponent draws a card.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(DRAW, ['players' => OPPONENT]),

    ];
  }
}

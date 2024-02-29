<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;


class BR_Rare_Kitsune extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_05_R2',
      'asset' => 'ALT_CORE_B_MU_05_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Kitsune',
      'typeline' => 'Character - Spirit',
      'type' => CHARACTER,
      'flavorText' => '"Want to play a game of headman-hunter-fox with me? I promise not to cheat!"',
      'artist' => 'Gaga Zhou',
      'subtypes' => [SPIRIT],
      'effectDesc' => '{H} Each player draws a card.',
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(DRAW, []),
    ];
  }
}

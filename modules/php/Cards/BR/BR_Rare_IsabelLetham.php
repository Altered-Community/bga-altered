<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_IsabelLetham extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_90_R1',
      'asset'  => 'ALT_DUSTER_B_BR_90_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Isabel Letham"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The lowest point of the wave is where she draws all her strength.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{R} #<RESUPPLY>, then# you may <RUSH>.'),
      'forest' => 2,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'costReserve'],
      'effectReserve' => FT::SEQ(
        FT::ACTION(RESUPPLY, []),
        FT::SEQ_OPTIONAL_MANUAL(FT::RUSH())
      )
    ];
  }
}

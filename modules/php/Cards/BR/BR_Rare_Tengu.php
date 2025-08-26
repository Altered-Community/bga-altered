<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Tengu extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_70_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_70_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Tengu"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Calling the Tengu means submitting to anger and vanity, no?" - Basira'),
      'artist' => "Ed Chee, S.Yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('#{J} You may <RUSH>. If you do, my Expedition <ASCENDS>.# (Rush means playing another card immediately.)'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ_OPTIONAL(
        FT::RUSH(),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => 'source'])
      )
    ];
  }
}

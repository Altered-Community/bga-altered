<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_RekaTradesman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_87_C',
      'asset'  => 'ALT_DUSTER_B_MU_87_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Tradesman"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Here\'s one for the road."'),
      'artist' => "Jefrey Yonathan",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{R} <RESUPPLY>, then create a <MANASEED> token in target opponent\'s Landmarks. (It\'s a Permanent with \"{T}, Sacrifice me: Ready a Mana Orb.\")'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectReserve' => FT::SEQ(
        FT::ACTION(RESUPPLY, []),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'NE_Common_Manaseed',
          'targetLocation' => [LANDMARK],
          'targetPlayer' => OPPONENT
        ]),
      )
    ];
  }
}

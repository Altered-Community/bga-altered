<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_RekaTradesman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_87_R1',
      'asset'  => 'ALT_DUSTER_B_MU_87_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Tradesman"),
      'typeline' => clienttranslate("Character - Merchant"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"Here\'s one for the road."'),
      'artist' => "Jefrey Yonathan",
      'extension' => 'SDU',
      'subtypes'  => [MERCHANT],
      'effectDesc' => clienttranslate('{R} Put the top card of your deck #in your Mana zone# (as an exhausted Mana Orb), then create a <MANASEED> token in target opponent\'s Landmarks.'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costReserve'],
      'effectReserve' => FT::SEQ(
        FT::ACTION(DRAW_MANA, []),
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

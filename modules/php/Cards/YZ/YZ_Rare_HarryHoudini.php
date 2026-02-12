<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_HarryHoudini extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_86_R1',
      'asset'  => 'ALT_DUSTER_B_YZ_86_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Harry Houdini"),
      'typeline' => clienttranslate("Character - Artist Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The secret of illusion lies in misdirection.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST, MAGE],
      'effectDesc' => clienttranslate('{H} Create a <MANA_MOTH> Illusion token in #target Expedition.# Then, #the controller of the Expedition facing that Illusion# draws a card.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
      'effectHand' =>
      FT::XOR(
        FT::SEQ(
          FT::ACTION(TARGET_EXPEDITION, [
            'players' => OPPONENT,
            'effect' =>
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'YZ_Common_ManaMoth',
            ]),
          ]),
          FT::ACTION(DRAW, ['players' => ME])
        ),
        FT::SEQ(
          FT::ACTION(TARGET_EXPEDITION, [
            'players' => ME,
            'effect' =>
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'YZ_Common_ManaMoth',
            ]),
          ]),
          FT::ACTION(DRAW, ['players' => OPPONENT])
        ),
      )
    ];
  }
}

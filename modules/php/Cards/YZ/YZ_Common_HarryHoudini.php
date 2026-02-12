<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_HarryHoudini extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_YZ_86_C',
      'asset'  => 'ALT_DUSTER_B_YZ_86_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Harry Houdini"),
      'typeline' => clienttranslate("Character - Artist Mage"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The secret of illusion lies in misdirection.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SDU',
      'subtypes'  => [ARTIST, MAGE],
      'effectDesc' => clienttranslate('{H} Create a <MANA_MOTH> Illusion token in an opponent\'s Expedition, then draw a card.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
      'effectHand' => FT::SEQ(
        FT::ACTION(TARGET_EXPEDITION, [
          'players' => OPPONENT,
          'effect' =>
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'YZ_Common_ManaMoth',
          ]),
        ]),
        FT::ACTION(DRAW, ['players' => ME])
      )
    ];
  }
}

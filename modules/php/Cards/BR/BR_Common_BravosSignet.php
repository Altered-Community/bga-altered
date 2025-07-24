<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_79_C',
      'asset'  => 'ALT_CYCLONE_B_BR_79_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bravos Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Courage and excellence.'),
      'artist' => "Ed Chee, S.Yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('Choose one:  • Target Character gains 3 boosts.  • Return target Character with Hand Cost {3} or less to its owner\'s hand.  • Put the top card of your deck in your Mana zone (as an exhausted Mana Orb).'),
      'costHand' => 3,
      'costReserve' => 4,
      'effectPlayed' => FT::XOR(
        FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST, 3])]),
        FT::ACTION(TARGET, ['maxHandCost' => 3, 'targetType' => [CHARACTER], 'effect' => FT::RETURN_TO_HAND()]),
        FT::ACTION(DRAW_MANA, [])
      )
    ];
  }
}

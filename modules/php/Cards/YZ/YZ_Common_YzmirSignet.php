<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_YzmirSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_76_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_76_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Yzmir Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Secrecy and sacrifice.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('Choose one:  • Send to Reserve target Character with Hand Cost {2} or less.  • <SABOTAGE>.  • Draw a card.'),
      'costHand' => 2,
      'costReserve' => 4,
      'effectPlayed'=> FT::XOR(
        FT::ACTION(TARGET, ['maxHandCost' => 2, 'effect' => FT::DISCARD_TO_RESERVE()]),
        FT::SABOTAGE(),
        FT::ACTION(DRAW, ['players'=>ME])
      )
    ];
  }
}

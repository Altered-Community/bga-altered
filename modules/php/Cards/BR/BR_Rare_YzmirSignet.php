<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_YzmirSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_76_R2',
      'asset'  => 'ALT_CYCLONE_B_YZ_76_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Yzmir Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Secrecy and sacrifice.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Send to Reserve target Character with Hand Cost {2} or less.  • <SABOTAGE>.  • Draw a card.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        [
          'type' => NODE_OR,
          'args' => ['n' => 2],
          'pId' => 'source',
          'childs' => [
            FT::ACTION(TARGET, ['maxHandCost' => 2, 'effect' => FT::DISCARD_TO_RESERVE()]),
            FT::SABOTAGE(),
            FT::ACTION(DRAW, ['players' => ME])
          ]
        ]
      )
    ];
  }
}

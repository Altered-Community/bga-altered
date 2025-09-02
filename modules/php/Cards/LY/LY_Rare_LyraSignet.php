<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LyraSignet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_78_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_78_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Lyra Signet"),
      'typeline' => clienttranslate("Spell - Conjuration"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Creation and transformation.'),
      'artist' => "Ed Chee, S.yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [CONJURATION],
      'effectDesc' => clienttranslate('#<FLEETING>.#  Choose #two:#  • Up to two target Characters gain <FLEETING>.  • Draw a card, then roll a die. On a 4+, <RESUPPLY_LOW>.  • Target Character gains 1 boost per card in your Reserve.'),
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
            FT::ACTION(TARGET, [
              'upTo' => true,
              'n' => 2,
              'effect' => FT::GAIN(EFFECT, FLEETING)
            ]),
            FT::SEQ(
              FT::ACTION(DRAW, ['players' => ME]),
              FT::ACTION(ROLL_DIE, [
                'effect' => [
                  '4+' => FT::ACTION(RESUPPLY, [])
                ]
              ])
            ),
            FT::ACTION(TARGET, [
              'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostTargetReserveCards'])
            ]),
          ]
        ]
      )
    ];
  }
}

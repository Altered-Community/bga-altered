<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_MiaPrimaBallerina extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_LY_114_R1',
      'asset'  => 'ALT_EOLE_B_LY_114_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mia, Prima Ballerina"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The former Matriarch of the Kasirga clan leads the dance, however macabre it may be.'),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [ARTIST],
      'effectDesc' => clienttranslate('#When you pass - You may activate my {D} ability. If you do, I gain <FLEETING>.#'),
      'supportDesc' => clienttranslate('{D} : Target Character gains <FLEETING>.'),
      'supportIcon' => 'discard',
      'forest' => 5,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectSupport' => [
        'targetPlayer' => ME,
        'effect' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, FLEETING)]),
      ],
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isMe'],
          'output' => FT::ACTION(TARGET, [
            'upTo' => true,
            'effect' => FT::SEQ(
              FT::GAIN(EFFECT, FLEETING),
              FT::GAIN(ME, FLEETING),
            ),
          ]),
        ]
      ]
    ];
  }
}

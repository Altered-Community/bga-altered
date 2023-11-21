<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '26',
      'asset' => 'AX-30-BrassbugQueen-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => '',
      'rarity' => RARITY_COMMON,
      'type' => PERMANENT,
      'subtype' => '',

      'effectDesc' => clienttranslate('{J} Create a [2/2/2 Brassbug] Robot token.  At Dawn - Activate my {J} effect.'),
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::XOR(
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_RIGHT],
        ]),
        FT::ACTION(INVOKE_TOKEN, [
          'pId' => $this->getPId(),
          'tokenType' => 'AX_Common_Brassbug',
          'targetLocation' => [STORM_LEFT],
        ])
      ),
      'effectPassive' => [
        'Dawn' => [
          'condition' => 'myTurn',
          'output' => FT::XOR(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => [STORM_RIGHT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => [STORM_LEFT],
            ])
          )
        ],
      ],
    ];
  }
}

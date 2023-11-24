<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_C',
      'asset' => 'ALT_CORE_B_AX_30_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hive'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('{J} Create a [BRASSBUG] Robot token.  At Dawn - Activate my {J} effect.  '),
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
          ),
        ],
      ],
    ];
  }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_R1',
      'asset' => 'ALT_CORE_B_AX_30_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate('What could possibly go wrong with an absorbing, self-replicating cute little robot?'),
      'effectDesc' => clienttranslate(
        '{J} Create a [BRASSBUG] Robot token in target Expedition.  At Noon — Create a [BRASSBUG] Robot token in target Expedition.  #When a Robot joins your Expeditions — It gains 1 boost.#'
      ),
      'costHand' => 6,
      'costReserve' => 6,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => $this->getPId(),
        'tokenType' => 'AX_Common_Brassbug',
        'targetLocation' => STORMS,
      ]),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => $this->getPId(),
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => STORMS,
          ]),
        ],
        'ChooseAssignment' => [
          'condition' => 'isRobotPlayed',
          'output' => FT::GAIN(EFFECT, BOOST)
        ],
        'InvokeToken' => [
          'condition' => 'isRobotPlayed',
          'output' => FT::GAIN(EFFECT, BOOST)
        ],
      ],
    ];
  }
}

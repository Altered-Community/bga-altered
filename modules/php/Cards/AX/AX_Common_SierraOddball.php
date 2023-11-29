<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_SierraOddball extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_01_C',
      'asset' => 'ALT_CORE_B_AX_01_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sierra & Oddball'),
      'type' => HERO,

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectDesc' => clienttranslate(
        'When you play a Permanent with a hand cost {3} or more, you may exhaust me ({T}) to create a [BRASSBUG] Robot token.'
      ),
      'effectPassive' => [
        'ChooseAssignment' => [
          'condition' => 'isPermanentAndCost3',
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, []),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => $this->getPId(),
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => STORMS
            ])
          ),
        ],
      ],
    ];
  }
}

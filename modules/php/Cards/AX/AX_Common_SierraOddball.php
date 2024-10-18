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
      'thumbnail' => 0,
      'statData' => 1,
      'typeline' => clienttranslate('Axiom Hero'),
      'effectDesc' => clienttranslate(
        'When you play a Permanent with Hand Cost {3} or more — You may exhaust me ({T}) to create a <BRASSBUG> Robot token in target Expedition.'
      ),
      'flavorText' => clienttranslate(
        'I don\'t know if there\'s a better reward than seeing something you\'ve built come to life.'
      ),
      'artist' => 'Taras Susak',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'ChooseAssignment' => [
          'conditions' => ['notTapped', 'isCardPlayed:permanent:3'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, []),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'AX_Common_Brassbug',
              'targetLocation' => STORMS,
            ])
          ),
        ],
      ],
    ];
  }
}

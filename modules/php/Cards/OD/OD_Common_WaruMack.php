<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_WaruMack extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_02_C',
      'asset' => 'ALT_CORE_B_OR_02_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Waru & Mack'),
      'typeline' => clienttranslate('Ordis Hero'),
      'type' => HERO,
      'flavorText' => clienttranslate('Bureaucracy is an art that requires careful planning.'),
      'artist' => 'Taras Susak',
      'effectDesc' => clienttranslate(
        'At Noon, if you control a Bureaucrat — Create an <ORDIS_RECRUIT> Soldier token in target Expedition.  When you play a Bureaucrat — You may have it gain <ASLEEP>. (During Dusk, ignore its statistics. During Rest, it doesn\'t go to Reserve and it loses Asleep.)'
      ),
      'reserveSlots' => 2,
      'landmarkSlots' => 2,
      'effectPassive' => [
        'Noon' => [
          'conditions' => ['isMe', 'hasControl:bureaucrat:1'],
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
            'targetLocation' => STORMS,
          ]),
        ],
        'ChooseAssignment' => [
          'condition' => 'isCardPlayed:bureaucrat',
          'output' => FT::SEQ_OPTIONAL(FT::ACTION(GAIN, ['cardId' => EFFECT, 'type' => ASLEEP, 'n' => 1])),
        ],
      ],
    ];
  }
}

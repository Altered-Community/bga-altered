<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Quetzalcoatl extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_18_C',
      'asset' => 'ALT_CORE_B_OR_18_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Quetzalcóatl'),
      'typeline' => clienttranslate('Character - Deity Bureaucrat'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('A soul has yet to be found who is bold enough to contest his wisdom.'),
      'artist' => 'Taras Susak',
      'subtypes' => [DEITY, BUREAUCRAT],
      'effectDesc' => clienttranslate(
        'When an opponent draws one or more cards or does <RESUPPLY_T> — Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectPassive' => [
        'Draw' => [
          'condition' => 'isOpponentDraw',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ],
        'Resupply' => [
          'condition' => 'isOpponentDraw',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ],
        'Morning' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ],
      ],
    ];
  }
}

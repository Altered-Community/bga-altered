<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Quetzalcoatl extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_18_R2',
      'asset' => 'ALT_CORE_B_OR_18_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Quetzalcóatl',
      'typeline' => 'Character - Deity Bureaucrat',
      'type' => CHARACTER,
      'flavorText' => 'A soul has yet to be found who is bold enough to contest his wisdom.',
      'artist' => 'Taras Susak',
      'subtypes' => [DEITY, BUREAUCRAT],
      'effectDesc' =>
      'When an opponent draws one or more cards or does <RESUPPLY_T> — Create an <ORDIS_RECRUIT> Soldier token in target Expedition.',
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
      'effectPassive' => [
        'Draw' => [
          'condition' => 'notMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ],
        'Resupply' => [
          'condition' => 'notMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ],
        'Morning' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'OD_Common_OrdisRecruit',
          ]),
        ]
      ]
    ];
  }
}

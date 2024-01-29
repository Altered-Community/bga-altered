<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_SubhashMarmo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_03_C',
      'asset' => 'ALT_CORE_B_AX_03_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Subhash & Marmo',
      'type' => HERO,
      'typeline' => 'Axiom Hero',
      'effectDesc' =>
        'At Noon — You may pay {1} and put a card from your hand in Reserve to create a <BRASSBUG> Robot token in target Expedition.',
      'flavorText' =>
        'There are still endless possibilities, even in a world of finite resources. In the end, it all comes down to how you choose to spend \'em.',
      'artist' => 'Taras Susak',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectPassive' => [
        'Noon' => [
          'condition' => 'myTurn',
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(PAY, ['pay' => 1]),
            FT::ACTION(TARGET, [
              'targetType' => [CHARACTER, SPELL, PERMANENT],
              'targetPlayer' => ME,
              'targetLocation' => [HAND],
              'effect' => FT::DISCARD_TO_RESERVE(),
            ]),
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

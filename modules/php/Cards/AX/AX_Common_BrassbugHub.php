<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_BrassbugHub extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_24_C',
      'asset' => 'ALT_CORE_B_AX_24_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug Hub'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} I gain three Kelon counters.  At Noon — You may pay {1} and spend one of my Kelon counters to create a [BRASSBUG] Robot token in target Expedition.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'gainCounter', 'args' => ['counter' => 3, 'counterName' => clienttranslate('Kelon counter')]],
      ],
      'effectPassive' => [
        'Dawn' => [
          'condition' => 'hasCounterOnCard',
          'output' => [
            'type' => NODE_SEQ,
            'optional' => true,
            'childs' => [
              FT::ACTION(USE_COUNTER, ['pay' => 1, 'consume' => 1]),
              FT::ACTION(INVOKE_TOKEN, [
                'pId' => $this->getPId(),
                'tokenType' => 'AX_Common_Brassbug',
                'targetLocation' => STORMS,
              ]),
            ],
          ],
        ],
      ],
      'flavorText' => clienttranslate(
        'Few people visit the depths of the Foundry, and even fewer can explain how the Brassbugs came to be.'
      ),
      'typeline' => clienttranslate('Permanent - Landmark'),
    ];
  }
}

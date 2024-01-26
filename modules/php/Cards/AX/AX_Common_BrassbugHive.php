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
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Create a [BRASSBUG] Robot token in target Expedition.  At Noon — Create a [BRASSBUG] Robot token in target Expedition.'
      ),
      'flavorText' => clienttranslate('What could possibly go wrong with an adorable little self-replicating autonomous robot?'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'artist' => 'HuoMiao Studio',

      'costHand' => 5,
      'costReserve' => 5,
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
      ],
    ];
  }
}

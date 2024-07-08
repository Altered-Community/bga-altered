<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_BrassbugHive extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_30_R2',
      'asset' => 'ALT_CORE_B_AX_30_R',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Brassbug Hive'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'flavorText' => clienttranslate('What could possibly go wrong with an adorable little self-replicating autonomous robot?'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} Create a <BRASSBUG> Robot token in target Expedition.  At Noon — Create a <BRASSBUG> Robot token in target Expedition.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'AX_Common_Brassbug',
        'targetLocation' => STORMS,
      ]),
      'effectPassive' => [
        'Noon' => [
          'condition' => 'isMe',
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'AX_Common_Brassbug',
            'targetLocation' => STORMS,
          ]),
        ],
      ],
    ];
  }
}

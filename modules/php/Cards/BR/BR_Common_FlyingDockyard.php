<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_FlyingDockyard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_82_C',
      'asset'  => 'ALT_CYCLONE_B_BR_82_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Flying Dockyard"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Cast off, and let the hunt begin!" - Sol'),
      'artist' => "Ed Chee, S.Yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('When you pass first — Create an <AEROLITH> token in your Landmarks. (It\'s a Permanent with \"When I\'m sacrificed — Resupply. {T}, {1}: Sacrifice me.\")'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isFirstPassing', 'isMe'],
          'output' => FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'NE_Common_Aerolith',
            'targetLocation' => [LANDMARK],
          ]),
        ]
      ]
    ];
  }
}

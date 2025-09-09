<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_FlyingDockyard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_82_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_82_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Flying Dockyard"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Cast off, and let the hunt begin!" - Sol'),
      'artist' => "Ed Chee, S.Yong & Stephen",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('When you pass first — #Target Character gains 1 boost,# then create an <AEROLITH> token in #target player\'s# Landmarks.'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isFirstPassing', 'isMe'],
          'output' => FT::SEQ(
            FT::ACTION(TARGET, ['effect' => FT::ACTION(GAIN, ['type' => BOOST])]),
            FT::ACTION(
              TARGET_PLAYER,
              [
                'opponentsOnly' => false,
                'effect' =>
                FT::ACTION(INVOKE_TOKEN, [
                  'pId' => 'source',
                  'tokenType' => 'NE_Common_Aerolith',
                  'targetLocation' => [LANDMARK],
                ]),
              ]
            )
          )
        ]
      ]
    ];
  }
}

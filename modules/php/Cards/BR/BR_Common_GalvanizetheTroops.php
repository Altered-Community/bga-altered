<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_GalvanizetheTroops extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_120_C',
      'asset'  => 'ALT_EOLE_B_BR_120_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Galvanize the Troops"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate(''),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>. Then, you may have target Character you control gain <FLEETING>.  When you pass — If you control two or more <FLEETING> Characters, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: At Noon — If you are first player, <RESUPPLY_LOW>.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(RESUPPLY, []),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'targetPlayer' => ME,
          'upTo' => true,
          'effect' => FT::GAIN(EFFECT, FLEETING),
        ])
      ),
      'effectPassive' => [
        // Pass uses EndTurn listener in this rules engine.
        'EndTurn' => [
          'conditions' => ['isMe', 'hasControl::2:false:fleeting', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ], 
        'Noon' => [
          'conditions' => ['isThisFeatCompleted', 'isFirstPlayer'],
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
    ];
  }
}

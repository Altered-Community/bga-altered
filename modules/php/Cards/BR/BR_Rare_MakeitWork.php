<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_MakeitWork extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_121_R2',
      'asset'  => 'ALT_EOLE_B_AX_121_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Make it Work"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate(''),
      'artist' => "Zero Wen",
      'extension'=>'ROC',
      'subtypes'  => [FEAT,LANDMARK],
      'effectDesc' => clienttranslate('{J} Put a card from your hand in Reserve.  When you pass — If your hand is empty, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED>: {T} : If your hand is empty, <RESUPPLY_LOW>.'),
      'costHand' => 2, 
      'costReserve' => 2, 
      'changedStats' => ['costHand','costReserve'], 
            'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'effect' => FT::DISCARD_TO_RESERVE(),
      ]),
      'effectPassive' => [
        'EndTurn' => [
          'conditions' => ['isMe', 'isHandEmpty', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ]
      ],
      'effectTap' =>  FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isHandEmpty',
        'effect' => FT::ACTION(RESUPPLY, []),
      ])
    ];
  }
}

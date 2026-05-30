<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_PushBacktheNight extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_YZ_121_C',
      'asset'  => 'ALT_EOLE_B_YZ_121_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Push Back the Night"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Fear shall not pass!"'),
      'artist' => "Justice Wong",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} Draw a card.  At Noon — If six or more cards are in your discard pile, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED>: When a card is discarded from your hand — You may exhaust me ({T}) to create a <MANA_MOTH> Illusion token in target Expedition.'),
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'effectPassive' => [
        'Noon' => [
          'conditions' => ['isMe', 'isThisFeatIncomplete', 'hasDiscardPileCards:6'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
        'Discard' => [
          'conditions' => ['hasSameOwner', 'isThisFeatCompleted', 'isDiscarded:hand:discard', 'notTapped'],
          'output' => FT::SEQ_OPTIONAL(
            FT::ACTION(TAP, []),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => 'source',
              'tokenType' => 'YZ_Common_ManaMoth',
              'targetLocation' => STORMS,
            ])
          ),
        ],
      ],
    ];
  }
}

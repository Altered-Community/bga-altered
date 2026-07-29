<?php
namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_ProtecttheAssets extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_BR_119_R1',
      'asset'  => 'ALT_EOLE_B_BR_119_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Protect the Assets"),
      'typeline' => clienttranslate("Landmark_permanent - Feat"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"If you want them, you\'ll have to go through me first!" — Kebba'),
      'artist' => "Zero Wen",
      'extension' => 'ROC',
      'subtypes'  => [FEAT, LANDMARK],
      'effectDesc' => clienttranslate('{J} Up to one target Character #gains 1 boost# and loses <FLEETING>.  At Noon — If there are two or more cards in your Reserve, complete me.'),
      'supportDesc' => clienttranslate('<COMPLETED_LOW>: Characters in your Reserve are <TOUGH_CHA_P_1>.'),
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => FT::ACTION(TARGET, [
        'upTo' => true,
        'effect' => FT::SEQ(FT::GAIN(EFFECT, BOOST), FT::LOOSE(EFFECT, FLEETING)),
      ]),
      'effectPassive' => [
        'Noon' => [
          'conditions' => ['isMe', 'checkReserveCards:2', 'isThisFeatIncomplete'],
          'output' => FT::ACTION(COMPLETE_FEAT, ['cardId' => 'source']),
        ],
      ],
      'effectCompleted' => [
        'reserveCharacterTough' => 1,
      ],
    ];
  }
}

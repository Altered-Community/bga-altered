<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_CorruptedPaju extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_108_R2',
      'asset'  => 'ALT_EOLE_B_AX_108_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Corrupted Paju"),
      'typeline' => clienttranslate("Character - Adventurer Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Gamon Studio",
      'extension'=>'ROC',
      'subtypes'  => [ADVENTURER,CORRUPTION],
      'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless your hand is empty.  #{J}# Create an <AEROLITH> token in your Landmarks.'),
      'supportDesc' => clienttranslate('#{D} : Create an <AEROLITH> token in target player\'s Landmarks.#'),
      'supportIcon' => 'discard',
      'forest' => 2, 
      'mountain' => 2, 
      'ocean' => 0, 
      'costHand' => 2, 
      'costReserve' => 2, 
      'changedStats' => ['ocean'], 
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'isHandEmpty',
        'effect' => null,
        'oppositeEffect' => FT::GAIN(ME, FLEETING),
      ]),
      'effectPlayed' => [
        'action' => INVOKE_TOKEN,
        'automatic' => true,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK]],
      ],
      'effectSupport' =>  [
        'action' => INVOKE_TOKEN,
        'args' => ['tokenType' => 'NE_Common_Aerolith', 'targetLocation' => [LANDMARK], 'allPlayers' => true],
      ],
    ];
  }
}

<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_CorruptedGargoyle extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_107_R2',
      'asset'  => 'ALT_EOLE_B_OR_107_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Corrupted Gargoyle"),
      'typeline' => clienttranslate("Character - Corruption Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('They have always instilled fear. As a group, they instill terror.'),
      'artist' => "Zero Wen",
      'extension'=>'ROC',
      'subtypes'  => [CORRUPTION,ELEMENTAL],
      'effectDesc' => clienttranslate('#I can\'t be played# unless there\'s another Character in each of your Expeditions.  #{J}# Target Expedition <ASCENDS>.'),
      'forest' => 3, 
      'mountain' => 3, 
      'ocean' => 1, 
      'costHand' => 2, 
      'costReserve' => 2, 
      'changedStats' => ['ocean'], 
      'playCondition' => 'controlInAllExpeditions',
      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'expedition' => 'source'])
    ];
  }
}

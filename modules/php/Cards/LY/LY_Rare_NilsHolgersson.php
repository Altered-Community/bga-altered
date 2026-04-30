<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Rare_NilsHolgersson extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
        'uid' => 'ALT_EOLE_B_OR_106_R2',
        'asset'  => 'ALT_EOLE_B_OR_106_R',

        'faction'  => FACTION_OD,
        'rarity'  => RARITY_RARE,
        'name'  => clienttranslate("Nils Holgersson"),
        'typeline' => clienttranslate("Character - Citizen"),
        'type'  => CHARACTER,
        'flavorText'  => clienttranslate('Come on, saddle up! We need to fly in tight formation to evacuate as many as possible!'),
        'artist' => "Ba Vo",
        'extension'=>'ROC',
        'subtypes'  => [CITIZEN],
        'effectDesc' => clienttranslate('#{H} You may target a Character with Base Cost {1} or less. It switches Expeditions.#'),
        'supportDesc' => clienttranslate('#{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
        'supportIcon' => 'discard',
        'forest' => 0, 
        'mountain' => 3, 
        'ocean' => 3, 
        'costHand' => 2, 
        'costReserve' => 2,
        'effectHand'=> FT::ACTION(TARGET, [
            'upTo' => true,
            'excludeSelf' => true,
            'maxBaseCost' => 1, 
            'targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])
        ]),
        'effectSupport' => FT::ACTION(INVOKE_TOKEN, [
          'pId' => 'source',
          'tokenType' => 'OD_Common_OrdisRecruit',
        ]),
      ];
  }
}

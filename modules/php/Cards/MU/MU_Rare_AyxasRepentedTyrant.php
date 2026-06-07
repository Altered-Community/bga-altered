<?php
namespace ALT\Cards\MU;
use ALT\Helpers\FT;

class MU_Rare_AyxasRepentedTyrant extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_109_R2',
      'asset'  => 'ALT_EOLE_B_OR_109_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Ayxas, Repented Tyrant"),
      'typeline' => clienttranslate("Character - Noble Rogue"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I warned you of the danger you were heading into." — Ayxas'),
      'artist' => "Tristan Bideau",
      'extension'=>'ROC',
      'subtypes'  => [NOBLE,ROGUE],
      'effectDesc' => clienttranslate('{H} You may create a #<WOOLLYBACK> Animal# token in an opponent\'s Expedition to <SABOTAGE_LOW>.'),
      'forest' => 2, 
      'mountain' => 2, 
      'ocean' => 2, 
      'costHand' => 2, 
      'costReserve' => 2, 
      'changedStats' => ['forest','mountain','ocean','costHand','costReserve'],
      'effectHand' => FT::SEQ(
        FT::ACTION(TARGET_EXPEDITION, [
          'players' => OPPONENT,
          'effect' =>
          FT::ACTION(INVOKE_TOKEN, [
            'pId' => 'source',
            'tokenType' => 'MU_Common_Woollyback',
          ]),
        ]),
        FT::SABOTAGE()
      ) 
    ];
  }
}

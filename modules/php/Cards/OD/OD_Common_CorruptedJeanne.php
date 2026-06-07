<?php
namespace ALT\Cards\OD;
use ALT\Helpers\FT;

class OD_Common_CorruptedJeanne extends \ALT\Models\Card
{
  public function __construct($row){
		parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_OR_114_C',
      'asset'  => 'ALT_EOLE_B_OR_114_C',

    	'faction'  => FACTION_OD,
    	'rarity'  => RARITY_RARE,
    	'name'  => clienttranslate("Corrupted Jeanne"),
      'typeline' => clienttranslate("Character - Corruption Soldier"),
    	'type'  => CHARACTER,
    	'flavorText'  => clienttranslate('"I know they will all be driven out, except for those who die." — Jeanne'),
      'artist' => "Tristan Bideau",
			'extension'=>'ROC',
      'subtypes'  => [CORRUPTION,SOLDIER],
      'effectDesc' => clienttranslate('#I can\'t be played# unless there\'s another Character in each of your Expeditions.  When I leave the Expedition zone — Create an <ORDIS_RECRUIT> Soldier token in each of your Expeditions.'),
      'supportDesc' => clienttranslate('#{D} : Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
      'supportIcon' => 'discard',
      'forest' => 2, 
      'mountain' => 2, 
      'ocean' => 2, 
      'costHand' => 3, 
      'costReserve' => 3, 
      'changedStats' => ['forest','mountain','ocean'],
      'effectHand' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'controlInAllExpeditions',
        'effect' => null,
        'oppositeEffect' => FT::GAIN(ME, FLEETING),
      ]),
      'effectPassive' => [
        'LeaveExpedition' => [
          'pId' => CONTROLLER,
          'output' => FT::SEQ(
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_RIGHT],
            ]),
            FT::ACTION(INVOKE_TOKEN, [
              'pId' => CONTROLLER,
              'tokenType' => 'OD_Common_OrdisRecruit',
              'targetLocation' => [STORM_LEFT],
              'moreThan1' => true,
            ])
          ),
        ],
      ],
      'effectSupport' => FT::ACTION(INVOKE_TOKEN, [
        'pId' => 'source',
        'tokenType' => 'OD_Common_OrdisRecruit',
      ]), 
    ];
  }
}

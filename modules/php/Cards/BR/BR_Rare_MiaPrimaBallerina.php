<?php

namespace ALT\Cards\BR;
use ALT\Helpers\FT;

class BR_Rare_MiaPrimaBallerina extends \ALT\Models\Card
{
    public function __construct($row)
    {
		parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_114_R2',
            'asset'  => 'ALT_EOLE_B_LY_114_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Mia, Prima Ballerina"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The former Matriarch of the Kasirga clan leads the dance, however macabre it may be.'),
            'artist' => "Zero Wen",
			'extension'=>'ROC',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('#When you pass - You may activate my {D} ability. If you do, I gain <FLEETING>.#'),
 			'supportDesc' => clienttranslate('{D} : Target Character gains <FLEETING>.'),
 			'supportIcon' => 'discard',
            'forest' => 5, 
            'mountain' => 4, 
            'ocean' => 4, 
            'costHand' => 4, 
            'costReserve' => 4, 
            'effectSupport' => [
                'targetPlayer' => ME,
                'effect' => FT::ACTION(TARGET, ['effect' => FT::GAIN(EFFECT, FLEETING)]),
            ],
            'effectPassive' => [
                'EndTurn' => [
                    'conditions' => ['isFirstPassing', 'isMe'],
                    'output' => FT::SEQ_OPTIONAL(
                        FT::ACTION(TARGET, [
                            'targetPlayer' => ME,
                            'targetLocation' => [RESERVE],
                            'targetType' => [CHARACTER, TOKEN, PERMANENT, SPELL],
                            'effect' => FT::ACTION(DISCARD, []),
                        ]),
                        FT::GAIN(ME, FLEETING),
                    ),
                ]
            ]
        ];
    }
}
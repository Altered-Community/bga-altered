<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Gibil extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_40_R2',
            'asset'  => 'ALT_ALIZE_B_AX_40_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Gibil"),
            'typeline' => clienttranslate("Character - Engineer Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Symphonies begin with two notes, fires with a couple of sparks, and masterpieces with two drops of metal.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ENGINEER, DEITY],
            'effectDesc' => clienttranslate('{J} #If you control two or more Permanents, create two <BRASSBUG> Robot tokens in target Expedition. Otherwise,# create only one.'),
            'supportDesc' => clienttranslate('{D} : Activate the {j} abilities of target Permanent you control. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 6,
            'costReserve' => 6,
            'effectPlayed' => FT::XOR(
                FT::ACTION(CHECK_CONDITION, [
                    'condition' => 'hasControl:permanent:1:::LTE',
                    'description' => clienttranslate('Invoke 1 token'),
                    'effect' =>
                    FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'AX_Common_Brassbug',
                        'targetLocation' => STORMS,
                    ])
                ]),
                FT::ACTION(CHECK_CONDITION, [
                    'condition' => 'hasControl:permanent:2',
                    'description' => clienttranslate('Invoke 2 tokens'),
                    'effect' =>
                    FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'n' => 2,
                        'tokenType' => 'AX_Common_Brassbug',
                        'targetLocation' => STORMS,
                    ])
                ])
            ),
            'effectSupport' =>  FT::ACTION(TARGET, [
                'targetType' => [PERMANENT],
                'targetPlayer' => ME,
                'hasEffects' => ['Played'],
                'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
            ]),
        ];
    }
}

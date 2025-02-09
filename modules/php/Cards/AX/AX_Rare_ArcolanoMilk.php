<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_ArcolanoMilk extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_43_R2',
            'asset'  => 'ALT_ALIZE_B_BR_43_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Arcolano Milk"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Nobody knows where this "milk" actually comes from.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('When a Character joins my Expedition — It gains 1 boost and <FLEETING_CHAR>.'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST))
                ],
                'InvokeToken' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST))
                ],
                'MoveCard' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST))
                ],
            ],
            'blockAutomaticAction' => [LOOSE => [FLEETING => 1], GAIN => [FLEETING => 1]],

        ];
    }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_ArcolanoMilk extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_43_R1',
            'asset'  => 'ALT_ALIZE_B_BR_43_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Arcolano Milk"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Nobody knows where this "milk" actually comes from.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('When a Character joins my Expedition — It gains #2 boosts# and <FLEETING_CHAR>.'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST, 2))
                ],
                'InvokeToken' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST, 2))
                ],
                'MoveCard' => [
                    'conditions' => ['isCardAdded:character', 'isPlayedInSameLocation'],
                    'output' => FT::SEQ(FT::GAIN(EFFECT, FLEETING), FT::GAIN(EFFECT, BOOST, 2))
                ],
            ],
            'blockAutomaticAction' => [LOOSE => [FLEETING => 1], GAIN => [FLEETING => 1]],
        ];
    }
}

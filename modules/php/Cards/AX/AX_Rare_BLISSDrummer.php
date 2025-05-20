<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BLISSDrummer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_54_R2',
            'asset'  => 'ALT_BISE_B_LY_54_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("BLISS Drummer"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Throw your hands up in the air for everyone who\'s hauling out those amazing relics from the City of Scholars!" — Tamati'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('If I\'m <BOOSTED>, #Robots# cost {1} less to play from your Reserve, with a minimum of {1}.'),
            'supportDesc' => clienttranslate('{I} #At Noon — Choose one:#  • I gain 1 boost, up to a #max of 3.#  • #{T} : I gain 2 boosts, up to a max of 3.#'),
            'supportIcon' => 'infinity',
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 0,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['costReserve'],
            'effectInfinity' => [
                'effectPassive' => [
                    'Noon' => [
                        'condition' => 'isMe',
                        'output' => FT::XOR(
                            FT::ACTION(GAIN, ['cardId' => ME, 'type' => BOOST, 'upTo' => 3]),
                            FT::SEQ(
                                FT::ACTION(TAP, []),
                                FT::ACTION(GAIN, ['cardId' => ME, 'type' => BOOST, 'n' => 2, 'upTo' => 3]),
                            )
                        ),
                    ],
                ],
            ],
            'dynamicReduceReserveCost' => 'myRobot:hasBoost'
        ];
    }
}

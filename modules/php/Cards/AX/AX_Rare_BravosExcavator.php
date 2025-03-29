<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BravosExcavator extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_53_R2',
            'asset'  => 'ALT_BISE_B_BR_53_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bravos Excavator"),
            'typeline' => clienttranslate("Character - Citizen"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The depths of the city are filled with archaeological marvels... along with plenty of Sap!'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [CITIZEN],
            'effectDesc' => clienttranslate('When I leave the Expedition zone, for each of my boosts — You may #<AUGMENT> target card in play or in Reserve.# (If it has counters, it gains 1 more. This can\'t target Hero cards.)'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 3,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'LeaveExpedition' => [
                    'condition' => 'hasBoost',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXreserveBoost']),
                ],
            ],
        ];
    }
}

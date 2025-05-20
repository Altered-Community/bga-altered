<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Mesektet extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_62_R2',
            'asset'  => 'ALT_BISE_B_OR_62_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Mesektet"),
            'typeline' => clienttranslate("Landmark_permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Repaired by the Axiom, the pride of the Aegis takes flight once again.'),
            'artist' => "Taras Susak",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('At Noon — Create a #<BRASSBUG> Robot# token in each of your Expeditions that\'s behind or tied.'),
            'costHand' => 5,
            'costReserve' => 5,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPassive' => [
                'Noon' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'invokeBrassbugBehind'])
                ]
            ],
        ];
    }
}

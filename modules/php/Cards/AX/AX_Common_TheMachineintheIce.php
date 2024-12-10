<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TheMachineintheIce extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_32_C',
            'asset'  => 'ALT_ALIZE_B_AX_32_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("The Machine in the Ice"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('A relic left by those who came before.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('When I go to Reserve from anywhere — Exhaust me ({T}). (Exhausted cards can\'t be played and have no Support abilities.)  {H} Send me to Reserve.'),
            'forest' => 5,
            'mountain' => 3,
            'ocean' => 5,
            'costHand' => 1,
            'costReserve' => 3,
            'effectPassive' => [
                'LeaveExpedition' => [
                    'condition' => 'isToReserve',
                    'output' => FT::ACTION(
                        EXHAUST,
                        [
                            'cardId' => ME
                        ]
                    ),
                ],
                'LeaveOther' => [
                    'condition' => 'isToReserve',
                    'output' => FT::ACTION(
                        EXHAUST,
                        [
                            'cardId' => ME
                        ]
                    ),
                ],
            ],
            'effectHand' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => RESERVE]),
        ];
    }
}

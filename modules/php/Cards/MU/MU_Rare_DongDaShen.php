<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_DongDaShen extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_35_R2',
            'asset'  => 'ALT_ALIZE_B_OR_35_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Dong Da Shen"),
            'typeline' => clienttranslate("Character - Bureaucrat Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Justice is best served cold.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [BUREAUCRAT, DEITY],
            'effectDesc' => clienttranslate('#At Noon — #You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['mountain', 'ocean', 'costHand', 'costReserve'],
            'effectPassive' => [
                'Noon' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT],
                        'targetLocation' => [RESERVE],
                        'upTo' => true,
                        'effect' => FT::ACTION(EXHAUST, [])
                    ])
                ]
            ]
        ];
    }
}

<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_LeoRelicExpert extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_52_R1',
            'asset'  => 'ALT_BISE_B_OR_52_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Leo, Relic Expert"),
            'typeline' => clienttranslate("Character - Bureaucrat Scholar"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Certain ancient knowledge must not be allowed to fall into the wrong hands.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT, SCHOLAR],
            'effectDesc' => clienttranslate('At Night — $<SABOTAGE> after Rest.'),
            'forest' => 3,
            'mountain' => 4,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['mountain', 'costHand', 'costReserve'],
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AfterRestSabotage']),
                ]
            ]
        ];
    }
}

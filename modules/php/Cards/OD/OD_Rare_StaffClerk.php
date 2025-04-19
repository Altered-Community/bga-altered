<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_StaffClerk extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_51_R1',
            'asset'  => 'ALT_BISE_B_OR_51_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Staff Clerk"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Don\'t venture into the depths alone.'),
            'artist' => "Romain Kurdi",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('When an opponent plays a card from Reserve — Create an <ORDIS_RECRUIT> Soldier token in #target# Expedition.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isNotMe', 'isFromReserve', 'isAddedCardOpponentEvent'],
                    'output' => FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'OD_Common_OrdisRecruit',
                        'targetLocation' => STORMS,
                    ]),
                ],
            ]
        ];
    }
}

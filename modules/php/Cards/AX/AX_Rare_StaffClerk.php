<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_StaffClerk extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_51_R2',
            'asset'  => 'ALT_BISE_B_OR_51_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Staff Clerk"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Don\'t venture into the depths alone.'),
            'artist' => "Romain Kurdi",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('When #you# play another card from Reserve — Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['ocean', 'costHand', 'costReserve'],
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isMe', 'isFromReserve', 'excludeSelf', 'isCardAdded'],
                    'output' => FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'OD_Common_OrdisRecruit',
                        'targetLocation' => ['initialSource'],
                    ]),
                ],
            ]
        ];
    }
}

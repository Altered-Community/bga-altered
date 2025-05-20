<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Ariadne extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_57_C',
            'asset'  => 'ALT_BISE_B_OR_57_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Ariadne"),
            'typeline' => clienttranslate("Character - Bureaucrat Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Follow the thread, and you\'ll find me." — Ariadne'),
            'artist' => "Damian Audino",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT, NOBLE],
            'effectDesc' => clienttranslate('When an opponent plays a Character — If there are no Characters in the Expedition facing me, that Character switches Expeditions.'),
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 5,
            'costReserve' => 5,
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isNotMe', 'isAddedCardOpponentEvent:character', 'isOpponentExpeditionEmpty', 'isNotPlayedInSameLocation'],
                    'output' => FT::ACTION(MOVE_CARD, ['cardId' => EFFECT])
                ],
            ]
        ];
    }
}

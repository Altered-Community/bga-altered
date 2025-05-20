<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Ariadne extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_57_R2',
            'asset'  => 'ALT_BISE_B_OR_57_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ariadne"),
            'typeline' => clienttranslate("Character - Bureaucrat Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Follow the thread, and you\'ll find me." — Ariadne'),
            'artist' => "Damian Audino",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT, NOBLE],
            'effectDesc' => clienttranslate('When an opponent plays a Character — If there are no Characters in the Expedition facing me, that Character switches Expeditions.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['forest', 'mountain', 'ocean', 'costHand', 'costReserve'],
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isNotMe', 'isAddedCardOpponentEvent:character', 'isOpponentExpeditionEmpty', 'isNotPlayedInSameLocation'],
                    'output' => FT::ACTION(MOVE_CARD, ['cardId' => EFFECT])
                ],
            ]
        ];
    }
}

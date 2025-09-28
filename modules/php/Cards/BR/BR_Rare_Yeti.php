<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Yeti extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_36_R2',
            'asset'  => 'ALT_ALIZE_B_MU_36_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Yeti"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Not at all abominable.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} #You may have me# gain $<ASLEEP>.  When another Character joins your Expeditions — It gains 1 boost.'),
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 4,
            'changedStats' => ['mountain', 'ocean'],
            'effectHand' => FT::ACTION(GAIN, ['cardId' => ME, 'type' => ASLEEP, 'n' => 1], ['optional' => true]),
            'effectPassive' => [
                'ChooseAssignment' => [
                    'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                    'output' => FT::GAIN(EFFECT, BOOST),
                ],
                'InvokeToken' => [
                    'conditions' => ['isCardAdded:character:::true', 'hasSameOwner'],
                    'output' => FT::GAIN(EFFECT, BOOST),
                ],
            ],
        ];
    }
}

<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Yeti extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_36_C',
            'asset'  => 'ALT_ALIZE_B_MU_36_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Yeti"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Not at all abominable.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{H} I gain $<ASLEEP>.  When another Character joins your Expeditions — It gains 1 boost.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 4,
            'effectHand' => FT::GAIN(ME, ASLEEP),
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

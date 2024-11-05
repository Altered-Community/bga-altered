<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BravosRescuer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_36_R1',
            'asset'  => 'ALT_ALIZE_B_BR_36_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bravos Rescuer"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Their ranks will be composed of seasoned argonauts, ready to face the perils of the unknown!"'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('#{J} You may target another <FLEETING_CHAR> Character. It gains 2 boosts.#'),
            'supportDesc' => clienttranslate('{D} : Target Character loses <FLEETING>. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 1,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['mountain', 'ocean'],
            'effectSupport' => FT::ACTION(
                TARGET,
                [
                    'targetType' => [CHARACTER, TOKEN],
                    'effect' => FT::LOOSE(EFFECT, FLEETING)
                ]
            ),
            'effectPlayed' =>  FT::ACTION(
                TARGET,
                [
                    'targetType' => [CHARACTER, TOKEN],
                    'upTo' => true,
                    'excludeSelf' => true,
                    'statuses' => FLEETING,
                    'effect' => FT::GAIN(EFFECT, BOOST, 2)
                ]
            )
        ];
    }
}

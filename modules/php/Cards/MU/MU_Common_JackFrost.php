<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_JackFrost extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_31_C',
            'asset'  => 'ALT_ALIZE_B_MU_31_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Jack Frost"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Another holiday... Just the icing on the cake!'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{H} You may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 2,
            'mountain' => 1,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'effectHand' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'upTo' => true,
                'effect' => FT::ACTION(EXHAUST, [])
            ]),

        ];
    }
}

<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_RocketPuffin extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_33_R2',
            'asset'  => 'ALT_ALIZE_B_AX_33_R2',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Rocket Puffin"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Blasting off at the speed of light!'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{J} You may ready an exhausted card in Reserve. #If you do, I gain 1 boost.#'),
            'forest' => 2,
            'mountain' => 0,
            'ocean' => 3,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'isTapped' => true,
                'upTo' => true,
                'effect' => FT::SEQ(FT::ACTION(READY, []), FT::GAIN(ME, BOOST))
            ]),
        ];
    }
}

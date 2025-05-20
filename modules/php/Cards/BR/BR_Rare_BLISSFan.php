<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_BLISSFan extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_50_R2',
            'asset'  => 'ALT_BISE_B_LY_50_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("BLISS Fan"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('BLISS lets the fans who bring back the most Sap come up on stage with them.'),
            'artist' => "Aaron Ming",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('When a Character in your Reserve gains 1 or more boosts — I gain 1 boost.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 1,
            'effectPassive' => [
                'Gain' => [
                    'conditions' => ['isMyGainInReserve', 'isGain:boost', 'isGainCardType:character',],
                    'output' => FT::GAIN(ME, BOOST)
                ]
            ]
        ];
    }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_CuppaSap extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_60_R2',
            'asset'  => 'ALT_BISE_B_BR_60_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Cuppa Sap"),
            'typeline' => clienttranslate("Spell - Boon"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Sap beverages may not be everyone\'s cup of tea, but they sure perk you up!'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [BOON],
            'effectDesc' => clienttranslate('Target Character in Reserve gains 2 boosts.'),
            'costHand' => 1,
            'costReserve' => 2,
            'effectReserve' =>  FT::ACTION(TARGET, [
                'targetType' => [CHARACTER],
                'targetLocation' => [RESERVE],
                'effect' => FT::GAIN(EFFECT, BOOST, 2)
            ]),
        ];
    }
}

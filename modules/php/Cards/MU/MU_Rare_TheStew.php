<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheStew extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_62_R2',
            'asset'  => 'ALT_BISE_B_BR_62_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Stew"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Can you guess the secret ingredient? It\'s seasoned with Sap.'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} Target Character gains 1 boost.  Characters in my Expedition are <SEASONED_CHA_P>. (They keep their boosts when they go to Reserve.)'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' =>  FT::ACTION(TARGET, [
                'effect' => FT::GAIN(EFFECT, BOOST)
            ]),
            'expeditionSeasoned' => true,
        ];
    }
}

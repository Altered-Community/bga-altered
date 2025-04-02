<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_TheStew extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_62_R1',
            'asset'  => 'ALT_BISE_B_BR_62_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("The Stew"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Can you guess the secret ingredient? It\'s seasoned with Sap.'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J}# You may pay {1}# to have target Character gain 1 boost #or lose <FLEETING>.#  Characters in my Expedition are <SEASONED_CHA_P>. (They keep their boosts when they go to Reserve.)'),
            'costHand' => 1,
            'costReserve' => 1,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' =>  FT::SEQ_OPTIONAL_MANUAL(
                FT::ACTION(PAY, ['pay' => 1]),
                FT::ACTION(TARGET, [
                    'effect' => FT::XOR(
                        FT::GAIN(EFFECT, BOOST),
                        FT::LOOSE(EFFECT, FLEETING)
                    )
                ])
            ),
            'expeditionSeasoned' => true,
        ];
    }
}

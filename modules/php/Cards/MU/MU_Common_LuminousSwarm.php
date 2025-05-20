<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_LuminousSwarm extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_55_C',
            'asset'  => 'ALT_BISE_B_MU_55_C',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Luminous Swarm"),
            'typeline' => clienttranslate("Character - Plant Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('They buzz about at night and spread their nectar when the sun is at its height.'),
            'artist' => "Khoa Viet",
            'extension' => 'WFTM',
            'subtypes'  => [PLANT, ANIMAL],
            'effectDesc' => clienttranslate('{J} I gain $<ANCHORED>.  At Noon — Target Character in play or in Reserve gains 1 boost.'),
            'forest' => 0,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::GAIN(ME, ANCHORED),
            'effectPassive' => [
                'Noon' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(TARGET, [
                        'targetLocation' => [RESERVE, STORM_LEFT, STORM_RIGHT],
                        'effect' => FT::GAIN(EFFECT, BOOST)
                    ])
                ],
            ],

        ];
    }
}

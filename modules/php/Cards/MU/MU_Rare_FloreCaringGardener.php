<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_FloreCaringGardener extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_54_R1',
            'asset'  => 'ALT_BISE_B_MU_54_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Flore, Caring Gardener"),
            'typeline' => clienttranslate("Character - Druid"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Every day that goes by without a Drillmole showing up is a blessing.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [DRUID],
            'supportDesc' => clienttranslate('{I} At Noon — Another target Character in play or in Reserve gains 1 boost.'),
            'supportIcon' => 'infinity',
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand'],
            'effectInfinity' => [
                'effectPassive' => [
                    'Noon' => [
                        'condition' => 'isMe',
                        'output' => FT::ACTION(TARGET, [
                            'targetLocation' => [RESERVE, STORM_LEFT, STORM_RIGHT],
                            'excludeSelf' => true,
                            'effect' => FT::GAIN(EFFECT, BOOST)
                        ])
                    ],
                ],
            ],
        ];
    }
}

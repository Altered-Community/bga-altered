<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_BurrowingNoosh extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_MU_49_R1',
            'asset'  => 'ALT_BISE_B_MU_49_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Burrowing Noosh"),
            'typeline' => clienttranslate("Character - Plant Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('It takes years for roots to punch their way through the hardest stone, but for them it only takes a few hours.'),
            'artist' => "Ba Vo",
            'extension' => 'WFTM',
            'subtypes'  => [PLANT, ANIMAL],
            'effectDesc' => clienttranslate('#When an opponent draws one or more cards or <RESUPPLIES> — I gain 1 boost.#'),
            'forest' => 1,
            'mountain' => 0,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 1,
            'changedStats' => ['forest'],
            'effectPassive' => [
                'Draw' => [
                    'condition' => 'isOpponentDraw',
                    'output' => FT::GAIN(ME, BOOST)
                ],
                'Resupply' => [
                    'conditions' => ['isOpponentDraw', 'realResupply'],
                    'output' => FT::GAIN(ME, BOOST)
                ],
                'Morning' => [
                    'condition' => 'isMe',
                    'output' => FT::GAIN(ME, BOOST)
                ],
            ],
        ];
    }
}

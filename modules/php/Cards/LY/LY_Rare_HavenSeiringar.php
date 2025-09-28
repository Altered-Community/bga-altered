<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_HavenSeiringar extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_34_R2',
            'asset'  => 'ALT_ALIZE_B_BR_34_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Haven Seiringar"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Those who have lived a lot have plenty to share.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('When I leave the Expedition Zone, if I was <FLEETING_CHAR> — Draw a card.  #{R} I gain 1 boost.#'),
            'forest' => 3,
            'mountain' => 0,
            'ocean' => 0,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['mountain', 'ocean'],
            'effectPassive' => [
                'LeaveExpedition' => [
                    'pId' => CONTROLLER,
                    'condition' => 'hasFleeting',
                    'output' => FT::ACTION(DRAW, ['players' => ME]),
                ],
            ],
            'effectReserve' => FT::GAIN(ME, BOOST),
        ];
    }
}

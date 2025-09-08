<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_HavenSeiringar extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_34_C',
            'asset'  => 'ALT_ALIZE_B_BR_34_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Haven Seiringar"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Those who have lived a lot have plenty to share.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('When I leave the Expedition Zone, if I was <FLEETING_CHAR> — Draw a card.'),
            'forest' => 3,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'LeaveExpedition' => [
                    'pId' => CONTROLLER,
                    'condition' => 'hasFleeting',
                    'output' => FT::ACTION(DRAW, ['players' => ME]),
                ],
            ],
        ];
    }
}

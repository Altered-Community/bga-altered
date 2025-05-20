<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_BravosPendekar extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_BR_51_R2',
            'asset'  => 'ALT_BISE_B_BR_51_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bravos Pendekar"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Rest. Raid. Repeat.'),
            'artist' => "Ed Chee, S.Yong & Stephen",
            'extension' => 'WFTM',
            'subtypes'  => [ADVENTURER],
            'effectDesc' => clienttranslate('At Night — If I have 2 or more boosts, <SABOTAGE> after Rest.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'hasBoost:2',
                    'output' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AfterRestSabotage']),
                ]
            ]
        ];
    }
}

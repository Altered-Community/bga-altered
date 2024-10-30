<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Skadi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_33_R1',
            'asset'  => 'ALT_ALIZE_B_BR_33_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Skadi"),
            'typeline' => clienttranslate("Character - Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Life is a slope. It\'s slow going up, and quick going down.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [DEITY],
            'effectDesc' => clienttranslate('{R} #If I\'m in {M}, <SABOTAGE>. Otherwise,# you may exhaust ({T}) target card in Reserve. (Exhausted cards can\'t be played and have no Support abilities.)'),
            'forest' => 2,
            'mountain' => 3,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 3,
            'effectReserve' => FT::XOR(
                FT::ACTION(CHECK_CONDITION, ['condition' => 'isInBiome:mountain', 'description' => clienttranslate('Sabotage'), 'effect' => FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
                    'targetLocation' => [RESERVE],
                    'upTo' => true,
                    'effect' => FT::ACTION(DISCARD, []),
                ]),]),
                FT::ACTION(
                    CHECK_CONDITION,
                    ['condition' => 'isNotInBiome:mountain', 'description' => clienttranslate('Exhaust'), 'effect' =>
                    FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT],
                        'targetLocation' => [RESERVE],
                        'upTo' => true,
                        'effect' => FT::ACTION(EXHAUST, [])
                    ])]
                )
            )
        ];
    }
}

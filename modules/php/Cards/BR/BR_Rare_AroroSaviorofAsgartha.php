<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_AroroSaviorofAsgartha extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_36_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_36_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Aroro, Savior of Asgartha"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Alone, she was able to turn back the tide.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{H} You may discard a #Character# from your Reserve. If you do, I gain #2 boosts#.'),
            'supportDesc' => clienttranslate('#{D} : The next Character you play this turn costs {1} less.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 3,
            'changedStats' => ['ocean'],
            'effectHand' => FT::ACTION(
                TARGET,
                [
                    'targetType' => [CHARACTER, TOKEN],
                    'targetPlayer' => ME,
                    'targetLocation' => [RESERVE],
                    'upTo' => true,
                    'effect' => FT::SEQ(FT::ACTION(DISCARD, []), FT::GAIN(ME, BOOST, 2)),
                ],
                ['optional' => true]
            ),
            'effectSupport' => [
                'action' => SPECIAL_EFFECT,
                'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1]],
            ],
        ];
    }
}

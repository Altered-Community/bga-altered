<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Metamorphosis extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_60_R2',
            'asset'  => 'ALT_BISE_B_YZ_60_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Metamorphosis"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Every reality contains its share of illusions.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Discard target Character #with Hand Cost {5} or less#, then create a <MANA_MOTH> Illusion token in its Expedition.'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, TOKEN],
                    'maxHandCost' => 5,
                    'effect' => FT::SEQ(
                        FT::ACTION(DISCARD, []),
                        FT::ACTION(INVOKE_TOKEN, [
                            'pId' => 'source',
                            'tokenType' => 'YZ_Common_ManaMoth',
                            'targetLocation' => ['source'],
                        ]),
                    )
                ]),
            )
        ];
    }
}

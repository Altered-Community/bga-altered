<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_SapExtractor extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_60_R2',
            'asset'  => 'ALT_BISE_B_AX_60_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sap Extractor"),
            'typeline' => clienttranslate("Landmark Permanent - Construction"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The Sap courses through the whole city like blood in a mortal\'s veins.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [CONSTRUCTION, LANDMARK],
            'effectDesc' => clienttranslate('At Noon — <AUGMENT_IMP> #any number# of target cards in play or in Reserve. (If they have counters, they gain 1 more. This can\'t target Hero cards.)'),
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'effectPassive' => [
                'Noon' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT, TOKEN],
                        'targetLocation' => [STORM_LEFT, STORM_RIGHT, LANDMARK, RESERVE],
                        'upTo' => true,
                        'n' => INFTY,
                        'augmentOnly' => true,
                        'effect' => FT::AUGMENT($this)
                    ]),
                ]
            ]
        ];
    }
}

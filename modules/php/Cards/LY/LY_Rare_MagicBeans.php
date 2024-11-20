<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_MagicBeans extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_43_R2',
            'asset'  => 'ALT_ALIZE_B_MU_43_R2',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Magic Beans"),
            'typeline' => clienttranslate("Expedition_permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Come on, spill the beans!'),
            'artist' => "Gael Giudicelli",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} Target Character in my Expedition gains 1 boost.  My region #and the region of the Expedition facing me# are {V} #and lose their other types.#'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'updateExpeditions' => ['type' => 'sourceAll', 'regionsRemove' => [OCEAN, MOUNTAIN], 'regionsAdd' => [FOREST]],
            'effectPlayed' => FT::ACTION(TARGET, ['targetLocation' => ['source'], 'effect' => FT::GAIN(EFFECT, BOOST)]),
        ];
    }
}

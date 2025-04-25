<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_ScholarsVault extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_63_R2',
            'asset'  => 'ALT_BISE_B_YZ_63_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Scholars' Vault"),
            'typeline' => clienttranslate("Landmark Permanent - Site"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Within its currents swim ancient knowledge and forgotten memories.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [SITE, LANDMARK],
            'effectDesc' => clienttranslate('#You may play Characters of Hand Cost {7} or more for {1} less.#  If there are one or more #Characters of Hand Cost {7} or more# in your Reserve, your Reserve limit is increased by one.'),
            'costHand' => 2,
            'costReserve' => 2,
            'dynamicReserveSlots' => '1:hasReserve:character:7',
            'reduceCostType' => [CHARACTER => ['minHandCost' => 7, 'reduction' => 1]]
        ];
    }
}

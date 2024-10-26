<?php

namespace ALT\Cards\YZ;

class YZ_Rare_SunisaDedicatedEnsign extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_38_R2',
            'asset'  => 'ALT_ALIZE_B_OR_38_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sunisa, Dedicated Ensign"),
            'typeline' => clienttranslate("Character - Soldier"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Forward or hold. There is no going back.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [SOLDIER],
            'effectDesc' => clienttranslate('$<DEFENDER_FS>.  If my Expedition is behind, <DEFENDER_CHA_P> Characters don\'t prevent it from moving forward.'),
            'forest' => 4,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 3,
            'costReserve' => 3,
            'defender' => true,
            'defenderIgnoreBehind' => true,
        ];
    }
}

<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_SunisaDedicatedEnsign extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_38_R1',
            'asset'  => 'ALT_ALIZE_B_OR_38_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Sunisa, Dedicated Ensign"),
            'typeline' => clienttranslate("Character - Soldier"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Forward or hold. There is no going back.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [SOLDIER],
            'effectDesc' => clienttranslate('$<DEFENDER_FS>.  If my Expedition is behind, <DEFENDER_CHA_P> Characters don\'t prevent it from moving forward.   #{J} Create an <ORDIS_RECRUIT> Soldier token in target Expedition.#'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'defender' => true,
            'defenderIgnoreBehind' => true,
            'dynamicIgnoreDefender' => '1:myExpeditionIsBehind',
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'OD_Common_OrdisRecruit',
            ]),
        ];
    }
}

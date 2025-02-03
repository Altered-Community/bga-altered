<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_MobileArmory extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_45_C',
            'asset'  => 'ALT_ALIZE_B_OR_45_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Mobile Armory"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The Ordis always come prepared.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} Create an <ORDIS_RECRUIT> Soldier token in my Expedition.'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'OD_Common_OrdisRecruit',
                'targetLocation' => ['source'],
            ]),
        ];
    }
}

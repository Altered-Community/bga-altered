<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_MobileArmory extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_45_R2',
            'asset'  => 'ALT_ALIZE_B_OR_45_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Mobile Armory"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('The Ordis always come prepared.'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} Create an <ORDIS_RECRUIT> Soldier token in my Expedition.  #<DEFENDER_CHA_P> Characters don\'t prevent my Expedition from moving forward.#'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'OD_Common_OrdisRecruit',
                'targetLocation' => ['source'],
            ]),
            'ignoreDefender' => true
        ];
    }
}

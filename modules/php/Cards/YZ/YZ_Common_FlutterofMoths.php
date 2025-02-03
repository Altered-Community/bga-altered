<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_FlutterofMoths extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_43_C',
            'asset'  => 'ALT_ALIZE_B_YZ_43_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Flutter of Moths"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Ballet with butterfly wings.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('I cost {1} less if there are two or more exhausted cards in Reserve.  Create three <MANA_MOTH> Illusion tokens, distributed as you choose among any number of target Expeditions.'),
            'costHand' => 6,
            'costReserve' => 6,
            'dynamicCostReduction' => "1:hasXExhaustedReserve:2",
            'effectPlayed' => FT::SEQ(
                FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'YZ_Common_ManaMoth',
                    'targetLocation' => STORMS,
                ]),
                FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'YZ_Common_ManaMoth',
                    'targetLocation' => STORMS,
                ]),
                FT::ACTION(INVOKE_TOKEN, [
                    'pId' => 'source',
                    'tokenType' => 'YZ_Common_ManaMoth',
                    'targetLocation' => STORMS,
                ]),
            )

        ];
    }
}

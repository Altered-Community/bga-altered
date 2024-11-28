<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_FlutterofMoths extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_43_R1',
            'asset'  => 'ALT_ALIZE_B_YZ_43_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Flutter of Moths"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Ballet with butterfly wings.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('I cost {1} less #for each exhausted card in Reserve.#  Create three <MANA_MOTH> Illusion tokens, distributed as you choose among any number of target Expeditions.'),
            'costHand' => 7,
            'costReserve' => 7,
            'changedStats' => ['costHand', 'costReserve'],
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

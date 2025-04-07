<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_EfrenPuppetMaster extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_LY_56_C',
            'asset'  => 'ALT_BISE_B_LY_56_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Efrén, Puppet Master"),
            'typeline' => clienttranslate("Character - Artist"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"I could never let the winding threads of fate separate me from my daughter." — Efrén'),
            'artist' => "Bastien Jez",
            'extension' => 'WFTM',
            'subtypes'  => [ARTIST],
            'effectDesc' => clienttranslate('{H} Roll a die:  • On a 4+, <SABOTAGE_LOW>. (Discard up to one target card from a Reserve.)  • On a 1-3, <RESUPPLY_LOW>. (Put the top card of your deck in Reserve.)'),
            'forest' => 4,
            'mountain' => 5,
            'ocean' => 4,
            'costHand' => 5,
            'costReserve' => 4,
            'effectHand' => FT::ACTION(ROLL_DIE, [
                'effect' => [
                    '4+' => FT::ACTION(TARGET, [
                        'targetType' => [CHARACTER, SPELL, PERMANENT],
                        'targetLocation' => [RESERVE],
                        'upTo' => true,
                        'effect' => FT::ACTION(DISCARD, []),
                    ]),
                    '1-3' => FT::ACTION(RESUPPLY, [])
                ]
            ])
        ];
    }
}

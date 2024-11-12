<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_TechnicalBoots extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_44_C',
            'asset'  => 'ALT_ALIZE_B_BR_44_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Technical Boots"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('There\'s no luck, only preparation.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('When my Expedition moves forward — Target Character in my Expedition loses <FLEETING_CHAR>.'),
            'costHand' => 1,
            'costReserve' => 1,
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'myExpeditionHasMoved',
                    'output' => FT::ACTION(TARGET, ['targetLocation' => ['source'], 'effect' => FT::ACTION(LOOSE, ['type' => FLEETING])]),
                ],
            ],
        ];
    }
}

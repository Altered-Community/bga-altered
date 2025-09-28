<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_TechnicalBoots extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_44_R2',
            'asset'  => 'ALT_ALIZE_B_BR_44_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Technical Boots"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('There\'s no luck, only preparation.'),
            'artist' => "Edward Chee & Seok Yeong",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('#{R} $<RESUPPLY>.#  When my Expedition moves forward — Target Character in my Expedition loses <FLEETING_CHAR>.'),
            'costHand' => 1,
            'costReserve' => 2,
            'changedStats' => ['costReserve'],
            'effectReserve' => FT::ACTION(RESUPPLY, []),
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'myExpeditionHasMoved',
                    'output' => FT::ACTION(TARGET, ['targetLocation' => ['source'], 'targetPlayer' => ME, 'effect' => FT::ACTION(LOOSE, ['type' => FLEETING])]),
                ],
                'MoveExpedition' => [
                    'condition' => 'myExpeditionHasMoved',
                    'output' => FT::ACTION(TARGET, ['targetLocation' => ['source'], 'targetPlayer' => ME, 'effect' => FT::ACTION(LOOSE, ['type' => FLEETING])]),
                ],
            ],
        ];
    }
}

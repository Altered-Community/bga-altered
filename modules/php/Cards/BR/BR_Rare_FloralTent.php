<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_FloralTent extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_MU_44_R2',
            'asset'  => 'ALT_ALIZE_B_MU_44_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Floral Tent"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('A beautiful shelter from the raging elements outside.'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} <RESUPPLY>.  If a #<BOOSTED> Character# would leave my Expedition during the Afternoon, #it loses all its boosts# instead.'),
            'supportDesc' => clienttranslate('#{D} : Target Character with Hand Cost {3} or less gains <ANCHORED>.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'costHand' => 2,
            'costReserve' => 1,
            'changedStats' => ['costHand'],
            'changedStats' => ['costHand'],
            'effectPlayed' =>  FT::ACTION(RESUPPLY, []),
            'protectBoostedInExpedition' => true,
            'effectSupport' => FT::ACTION(TARGET, ['maxHandCost' => 3, 'effect' => FT::GAIN(EFFECT, ANCHORED)]),
        ];
    }
}

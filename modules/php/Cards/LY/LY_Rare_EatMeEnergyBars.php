<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_EatMeEnergyBars extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_45_R2',
            'asset'  => 'ALT_ALIZE_B_BR_45_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Eat Me Energy Bars"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('Too good to share.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('#{J} I gain <FLEETING>.#  If there is only one Character in my Expedition, it is <GIGANTIC>. (It is considered present in each of your Expeditions.)'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand', 'costReserve'],
            'giganticOneCharacter' => true,
            'effectPlayed' => FT::GAIN(ME, FLEETING),
        ];
    }
}

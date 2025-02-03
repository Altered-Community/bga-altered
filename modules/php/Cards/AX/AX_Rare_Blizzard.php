<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Blizzard extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_42_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_42_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Blizzard"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('The icy winds wrecked the army, despite months of preparation.'),
            'artist' => "Jean-Baptiste Andirer",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('<FLEETING>.  Send to Reserve each Character from target Expedition, then exhaust them ({T}).'),
            'costHand' => 5,
            'costReserve' => 5,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'sendToReserveCharactersAndExhaustInExpedition'])])
            )
        ];
    }
}

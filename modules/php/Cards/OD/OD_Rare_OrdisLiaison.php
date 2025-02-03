<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_OrdisLiaison extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_41_R1',
            'asset'  => 'ALT_ALIZE_B_OR_41_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ordis Liaison"),
            'typeline' => clienttranslate("Character - Messenger Soldier"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"How may I help you?"'),
            'artist' => "Taras Susak",
            'extension' => 'TBF',
            'subtypes'  => [MESSENGER, SOLDIER],
            'effectDesc' => clienttranslate('{J} Each Character #in target Expedition# gains 1 boost.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'effectPlayed' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAllCharactersInExpedition'])])
        ];
    }
}

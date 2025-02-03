<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_Geyser extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_42_R1',
            'asset'  => 'ALT_ALIZE_B_BR_42_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Geyser"),
            'typeline' => clienttranslate("Spell - Disruption"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Under pressure!'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [DISRUPTION],
            'effectDesc' => clienttranslate('Return target Character or Permanent to its owner\'s hand, then #you may# put me in your Mana Orbs (as an exhausted Mana Orb).'),
            'costHand' => 4,
            'costReserve' => 3,
            'changedStats' => ['costReserve'],
            'effectPlayed' => FT::SEQ(
                FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN, PERMANENT], 'effect' => FT::RETURN_TO_HAND()]),
                FT::ACTION(DISCARD, [
                    'cardId' => ME,
                    'destination' => MANA,
                    'tapped' => true,
                    'force' => true,
                    'canPass' => true,
                ]),
            ),
        ];
    }
}

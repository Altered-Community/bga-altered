<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_MagpengHoarder extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_31_R1',
            'asset'  => 'ALT_ALIZE_B_LY_31_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Magpeng Hoarder"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Why does it need all these? Might come in handy someday!'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('{J} If you have two or more cards in Reserve, I gain #2 boosts# and $<FLEETING_CHAR>.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, ['condition' => 'checkReserveCards:2', 'effect' => FT::SEQ(FT::GAIN(ME, BOOST, 2), FT::GAIN(ME, FLEETING))])

        ];
    }
}

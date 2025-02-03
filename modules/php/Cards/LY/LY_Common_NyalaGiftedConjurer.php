<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_NyalaGiftedConjurer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_34_C',
            'asset'  => 'ALT_ALIZE_B_LY_34_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Nyala, Gifted Conjurer"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Of course I\'m cheating. That\'s what magic is all about."'),
            'artist' => "Anh Tung",
            'extension' => 'TBF',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{J} Exchange target card from your Reserve with a card from your Hand.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 0,
            'costHand' => 3,
            'costReserve' => 3,
            'effectPlayed' => FT::ACTION(EXCHANGE, ['targetType' => [PERMANENT, SPELL, CHARACTER]]),
        ];
    }
}

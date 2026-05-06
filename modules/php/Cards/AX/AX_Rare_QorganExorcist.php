<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;
use ALT\Models\Card;

class AX_Rare_QorganExorcist extends Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_112_R2',
            'asset' => 'ALT_EOLE_B_YZ_112_R',

            'faction' => FACTION_AX,
            'rarity' => RARITY_RARE,
            'name' => clienttranslate('Qorgan Exorcist'),
            'typeline' => clienttranslate('Character - Mage'),
            'type' => CHARACTER,
            'subtypes' => [MAGE],
            'effectDesc' => clienttranslate('#{J} If six or more cards are in your discard pile, I gain 1 boost.# Otherwise, discard the top card of your deck.'),
            'flavorText' => clienttranslate("Now we just need to cover Sam's back."),
            'artist' => 'Nestor Papatriantafyllou',
            'extension' => 'ROC',

            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
                'condition' => ['hasDiscardPileCards:6:GTE'],
                'effect' => FT::GAIN(ME, BOOST, 1),
                'oppositeEffect' => FT::ACTION(DISCARD_FROM_DECK, ['players' => ME, 'n' => 1])
            ])
        ];
    }
}

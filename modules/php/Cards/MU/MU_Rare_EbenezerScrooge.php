<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_EbenezerScrooge extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_37_R2',
            'asset'  => 'ALT_ALIZE_B_OR_37_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ebenezer Scrooge"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Darkness is cheap, and that\'s why Scrooge liked it.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('#Cards played from Reserve cost {1} less, with a minimum cost of {1}.#'),
            'supportDesc' => clienttranslate('{D} : Target Character you control with Hand Cost {4} or less gains <ASLEEP>. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'reduceReserveCost' => 1,
            'effectSupport' => FT::ACTION(TARGET, [
                'targetPlayer' => ME,
                'targetType' => [CHARACTER, TOKEN],
                'maxHandCost' => 4,
                'effect' => FT::GAIN(EFFECT, ASLEEP),
            ]),
        ];
    }
}

<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_EbenezerScrooge extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_37_C',
            'asset'  => 'ALT_ALIZE_B_OR_37_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Ebenezer Scrooge"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Darkness is cheap, and that\'s why Scrooge liked it.'),
            'artist' => "Romain Kurdi",
            'extension' => 'TBF',
            'subtypes'  => [BUREAUCRAT],
            'supportDesc' => clienttranslate('{D} : Target Character you control with Hand Cost {4} or less gains <ASLEEP>. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'effectSupport' => FT::ACTION(TARGET, [
                'targetPlayer' => ME,
                'targetType' => [CHARACTER, TOKEN],
                'maxHandCost' => 4,
                'effect' => FT::GAIN(EFFECT, ASLEEP),
            ]),
        ];
    }
}

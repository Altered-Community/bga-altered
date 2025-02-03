<?php

namespace ALT\Cards\OD;

class OD_Rare_OrdisNightwarden extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_36_R1',
            'asset'  => 'ALT_ALIZE_B_OR_36_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Ordis Nightwarden"),
            'typeline' => clienttranslate("Character - Bureaucrat"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Work doesn\'t stop when the sun goes down.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [BUREAUCRAT],
            'effectDesc' => clienttranslate('If I would gain <ASLEEP>, #I gain $<ANCHORED> instead.#'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'dynamicGainReplace' => [ASLEEP => ANCHORED]

        ];
    }
}

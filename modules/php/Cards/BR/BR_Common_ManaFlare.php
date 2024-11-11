<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_ManaFlare extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_41_C',
            'asset'  => 'ALT_ALIZE_B_BR_41_C',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Mana Flare"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('He summons the mightiest beings just for the sake of an epic duel.'),
            'artist' => "Justice Wong",
            'extension' => 'TBF',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('<FLEETING>.  Immediately play a Character for {5} less. It gains <FLEETING_CHAR>. (If it would be sent to Reserve, discard it instead.)'),
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                [
                    'action' => SPECIAL_EFFECT,
                    'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 5, 'permanent' => false]],
                ],
                FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterFleeting']),
                FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [CHARACTER], 'actions' => ['play']])
            )
        ];
    }
}

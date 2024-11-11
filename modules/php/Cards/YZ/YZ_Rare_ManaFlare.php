<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_ManaFlare extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_41_R2',
            'asset'  => 'ALT_ALIZE_B_BR_41_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Mana Flare"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('He summons the mightiest beings just for the sake of an epic duel.'),
            'artist' => "Justice Wong",
            'extension' => 'TBF',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('$<FLEETING>.  Immediately play a #Spell# for {5} less.'),
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                [
                    'action' => SPECIAL_EFFECT,
                    'args' => ['effect' => 'costReduction', 'args' => ['type' => SPELL, 'reduction' => 5, 'permanent' => false]],
                ],
                FT::ACTION(CHOOSE_ASSIGNMENT, ['types' => [SPELL], 'actions' => ['play']])
            )
        ];
    }
}

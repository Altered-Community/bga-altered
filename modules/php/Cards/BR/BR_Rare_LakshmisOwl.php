<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_LakshmisOwl extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_LY_119_R2',
            'asset'  => 'ALT_EOLE_B_LY_119_R',

            'faction'  => FACTION_BR,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Lakshmi's Owl"),
            'typeline' => clienttranslate("Character - Animal, Spirit"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Even in the blackest night, I can see light.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'ROC',
            'subtypes'  => [ANIMAL, SPIRIT],
            'effectDesc' => clienttranslate('When #a Character gains one or more boosts# — If I have no boosts, #I gain 1 boost#. $<BB>'), 
            'supportDesc' => clienttranslate('{D} : Pay {1} less for the next Character you play this turn, down to a minimum of {1}. (Discard me from Reserve to do this.)'),
            'forest' => 0,
            'mountain' => 1,
            'ocean' => 0,
            'costHand' => 1,
            'costReserve' => 1,
            'supportIcon' => 'discard',
            'effectPassive' => [
                'Gain' => [ 
                    'conditions' => ['isGain:boost', 'hasBoost:0:LTE', 'isInStorms'],
                    'output' => FT::GAIN(ME, BOOST),
                ],
            ],
            'effectSupport' => [
              'action' => SPECIAL_EFFECT,
              'args' => ['effect' => 'costReduction', 'args' => ['type' => CHARACTER, 'reduction' => 1,'minimum' => 1]],
            ],
        ];
    }
}

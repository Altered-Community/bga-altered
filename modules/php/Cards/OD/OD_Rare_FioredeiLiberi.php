<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_FioredeiLiberi extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_56_R1',
            'asset'  => 'ALT_BISE_B_OR_56_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Fiore dei Liberi"),
            'typeline' => clienttranslate("Character - Soldier Noble"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"I am the sword, deadly against all weapons!" — Fiore'),
            'artist' => "Jean-Baptiste Andrier",
            'extension' => 'WFTM',
            'subtypes'  => [SOLDIER, NOBLE],
            'effectDesc' => clienttranslate('If I\'m <BOOSTED>, I\'m $<ETERNAL>.  {J} I gain 1 boost per other Character in my Expedition, then send them all to Reserve.  At Night — I lose 1 boost.'),
            'forest' => 1,
            'mountain' => 1,
            'ocean' => 1,
            'costHand' => 3,
            'costReserve' => 3,
            'changedStats' => ['costHand', 'costReserve'],
            'dynamicEternal' => '1:hasBoost',
            'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostAndRemoveFromExpedition']),
            'effectPassive' => [
                'AfterDusk' => [
                    'conditions' => ['isMe', 'hasBoost'],
                    'output' => FT::LOOSE(ME, BOOST)
                ]
            ]
        ];
    }
}

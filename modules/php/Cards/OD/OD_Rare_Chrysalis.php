<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Chrysalis extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_33_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_33_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Chrysalis"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('...They build their ice cocoon to turn ethereal.'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('$<DEFENDER>.  When I leave the Expedition Zone — Create a <MANA_MOTH> Illusion token in my Expedition.'),
            'supportDesc' => clienttranslate('#{D} : Exhaust target card in Reserve.# (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['mountain'],
            'defender' => true,
            'effectPassive' => [
                'LeaveExpedition' => [
                    'pId' => CONTROLLER,
                    'output' => FT::ACTION(INVOKE_TOKEN, [
                        'pId' => CONTROLLER,
                        'tokenType' => 'YZ_Common_ManaMoth',
                        'targetLocation' => ['initialSource'],
                    ]),
                ],
            ],
            'effectSupport' => FT::ACTION(TARGET, [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetLocation' => [RESERVE],
                'effect' => FT::ACTION(EXHAUST, [])
            ])
        ];
    }
}

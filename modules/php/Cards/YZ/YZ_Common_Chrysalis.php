<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_Chrysalis extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_33_C',
            'asset'  => 'ALT_ALIZE_B_YZ_33_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Chrysalis"),
            'typeline' => clienttranslate("Character - Animal"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('...They build their ice cocoon to turn ethereal.'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ANIMAL],
            'effectDesc' => clienttranslate('$<DEFENDER>.  When I leave the Expedition Zone — Create a <MANA_MOTH> Illusion token in my Expedition.'),
            'forest' => 2,
            'mountain' => 1,
            'ocean' => 2,
            'costHand' => 2,
            'costReserve' => 2,
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
        ];
    }
}

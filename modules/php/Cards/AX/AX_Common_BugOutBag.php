<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_BugOutBag extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_AX_62_C',
            'asset'  => 'ALT_BISE_B_AX_62_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Bug-Out Bag"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('They forgot to pack the Eat Me energy bars.'),
            'artist' => "Kevin Sidharta",
            'extension' => 'WFTM',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('{J} Create a <BRASSBUG> Robot token in my Expedition.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'AX_Common_Brassbug',
                'targetLocation' => ['source'],
            ]),
        ];
    }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_BravosRescuer extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_BR_36_R2',
            'asset'  => 'ALT_ALIZE_B_BR_36_R2',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Bravos Rescuer"),
            'typeline' => clienttranslate("Character - Adventurer"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"Their ranks will be composed of seasoned argonauts, ready to face the perils of the unknown!"'),
            'artist' => "Zero Wen",
            'extension' => 'TBF',
            'subtypes'  => [ADVENTURER],
            'supportDesc' => clienttranslate('{D} : Target Character loses <FLEETING>. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 1,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 3,
            'costReserve' => 3,
            'effectSupport' => FT::ACTION(
                TARGET,
                [
                    'targetType' => [CHARACTER, TOKEN],
                    'effect' => FT::LOOSE(EFFECT, FLEETING)
                ]
            )
        ];
    }
}

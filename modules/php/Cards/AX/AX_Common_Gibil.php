<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Gibil extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_40_C',
            'asset'  => 'ALT_ALIZE_B_AX_40_C',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Gibil"),
            'typeline' => clienttranslate("Character - Engineer Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Symphonies begin with two notes, fires with a couple of sparks, and masterpieces with two drops of metal.'),
            'artist' => "Matteo Spirito",
            'extension' => 'TBF',
            'subtypes'  => [ENGINEER, DEITY],
            'effectDesc' => clienttranslate('{J} Create a <BRASSBUG> Robot token in target Expedition.'),
            'supportDesc' => clienttranslate('{D} : Activate the {j} abilities of target Permanent you control. (Discard me from Reserve to do this.)'),
            'supportIcon' => 'discard',
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 6,
            'costReserve' => 6,
            'effectPlayed' => FT::ACTION(INVOKE_TOKEN, [
                'pId' => 'source',
                'tokenType' => 'AX_Common_Brassbug',
                'targetLocation' => STORMS,
            ]),
            'effectSupport' =>  FT::ACTION(TARGET, [
                'targetType' => [PERMANENT],
                'targetPlayer' => ME,
                'hasEffects' => ['Played'],
                'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
            ]),
        ];
    }
}

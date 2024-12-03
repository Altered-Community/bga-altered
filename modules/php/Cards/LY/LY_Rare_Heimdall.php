<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Heimdall extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_38_R1',
            'asset'  => 'ALT_ALIZE_B_LY_38_R',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Heimdall"),
            'typeline' => clienttranslate("Character - Soldier Deity"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Proud guardian of the Bifröst, he decides who gets to switch sides.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'TBF',
            'subtypes'  => [SOLDIER, DEITY],
            'effectDesc' => clienttranslate('{H} You may have target Character #or Expedition Permanent# switch Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'),
            'forest' => 5,
            'mountain' => 0,
            'ocean' => 5,
            'costHand' => 4,
            'costReserve' => 4,
            'changedStats' => ['forest', 'mountain', 'ocean'],
            'effectPlayed' => FT::XOR(
                FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'upTo' => true, 'effect' => FT::ACTION(MOVE_CARD, [])]),
                FT::ACTION(TARGET, ['targetType' => [PERMANENT], 'upTo' => true, 'subtype' => EXPEDITION, 'effect' => FT::ACTION(MOVE_CARD, [])]),
            ),

        ];
    }
}

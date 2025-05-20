<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_YzmirNurse extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_51_R2',
            'asset'  => 'ALT_BISE_B_YZ_51_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Yzmir Nurse"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('The Cloister\'s Nurses may be harsh, but they work wonders, according to those who survive.'),
            'artist' => "Dimas Iswara",
            'extension' => 'WFTM',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{H} You may sacrifice a #Robot# or #Permanent.# If you do, I gain 2 boosts.'),
            'forest' => 2,
            'mountain' => 2,
            'ocean' => 2,
            'costHand' => 3,
            'costReserve' => 2,
            'effectHand' => FT::XOR_OPTIONAL(
                FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'upTo' => true,
                    'targetType' => [PERMANENT],
                    'effect' => FT::SEQ(
                        FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                        FT::GAIN(ME, BOOST, 2)
                    ),
                ]),
                FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'targetType' => [TOKEN, CHARACTER],
                    'subType' => ROBOT,
                    'upTo' => true,
                    'effect' => FT::SEQ(
                        FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                        FT::GAIN(ME, BOOST, 2)
                    ),
                ])
            )
        ];
    }
}

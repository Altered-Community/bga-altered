<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_Joyride extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_LY_40_R2',
            'asset'  => 'ALT_ALIZE_B_LY_40_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Joyride"),
            'typeline' => clienttranslate("Spell - Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Everything fun is life is either forbidden or completely crazy.'),
            'artist' => "Justice Wong",
            'extension' => 'TBF',
            'subtypes'  => [MANEUVER],
            'effectDesc' => clienttranslate('$<COOLDOWN>.  Discard another card from your Reserve. If you do, target Character gains 2 boosts.'),
            'costHand' => 1,
            'costReserve' => 1,
            'cooldown' => true,
            'effectPlayed' => FT::ACTION(
                TARGET,
                [
                    'targetType' => [CHARACTER, SPELL, PERMANENT],
                    'targetPlayer' => ME,
                    'excludeSelf' => true,
                    'targetLocation' => [RESERVE],
                    'effect' => FT::SEQ(
                        FT::ACTION(DISCARD, []),
                        FT::ACTION(
                            TARGET,
                            [
                                'effect' => FT::GAIN(EFFECT, BOOST, 2),
                            ],
                        )
                    )
                ],
            ),
        ];
    }
}

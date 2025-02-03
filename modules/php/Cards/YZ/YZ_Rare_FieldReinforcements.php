<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_FieldReinforcements extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_OR_43_R2',
            'asset'  => 'ALT_ALIZE_B_OR_43_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Field Reinforcements"),
            'typeline' => clienttranslate("Spell - Conjuration Maneuver"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('Supply lines can sometimes be the difference between failure and success.'),
            'artist' => "Jean-Baptiste andrier",
            'extension' => 'TBF',
            'subtypes'  => [CONJURATION, MANEUVER],
            'effectDesc' => clienttranslate('<FLEETING>.  Choose one. If each of your Expeditions is behind or tied, you may choose both:  • Draw a card.  • Create an <ORDIS_RECRUIT> Soldier token in target Expedition.'),
            'costHand' => 2,
            'costReserve' => 2,
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::XOR(
                    FT::ACTION(CHECK_CONDITION, [
                        'condition' => 'allExpeditionsAreBehindOrTied',
                        'description' => clienttranslate('Expeditions are behind of tied'),
                        'effect' => FT::OR(
                            FT::ACTION(DRAW, ['players' => ME]),
                            FT::ACTION(INVOKE_TOKEN, [
                                'pId' => 'source',
                                'tokenType' => 'OD_Common_OrdisRecruit',
                            ])
                        )
                    ]),
                    FT::ACTION(CHECK_CONDITION, [
                        'condition' => 'allExpeditionsAreNotBehindOrTied',
                        'description' => clienttranslate('Expeditions are not behind'),
                        'effect' =>
                        FT::XOR(
                            FT::ACTION(DRAW, ['players' => ME]),
                            FT::ACTION(INVOKE_TOKEN, [
                                'pId' => 'source',
                                'tokenType' => 'OD_Common_OrdisRecruit',
                            ])
                        )
                    ]),

                )
            )
        ];
    }
}

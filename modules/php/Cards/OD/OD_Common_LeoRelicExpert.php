<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_LeoRelicExpert extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_OR_52_C',
            'asset'  => 'ALT_BISE_B_OR_52_C',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Leo, Relic Expert"),
            'typeline' => clienttranslate("Character - Bureaucrat Scholar"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Certain ancient knowledge must not be allowed to fall into the wrong hands.'),
            'artist' => "Fahmi Fauzi",
            'extension' => 'WFTM',
            'subtypes'  => [BUREAUCRAT, SCHOLAR],
            'effectDesc' => clienttranslate('At Night — You may spend 1 counter from a card in your Reserve or Landmarks to <SABOTAGE_INF> after Rest. (Discard up to one target card from a Reserve.)'),
            'forest' => 3,
            'mountain' => 2,
            'ocean' => 3,
            'costHand' => 3,
            'costReserve' => 3,
            'costReserve' => 2,
            'effectPassive' => [
                'AfterDusk' => [
                    'condition' => 'isMe',
                    'output' => FT::ACTION(
                        TARGET,
                        [
                            'targetLocation' => [RESERVE, LANDMARK],
                            'targetPlayer' => ME,
                            'augmentOnly' => true,
                            'targetType' => TYPES,
                            'upTo' => true,
                            'effect' => FT::ACTION(SPEND, [
                                'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'AfterRestSabotage']),
                            ])
                        ]
                    ),
                ]
            ]
        ];
    }
}

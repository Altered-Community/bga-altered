<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_SylasCrypticWarlock extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_BISE_B_YZ_55_C',
            'asset'  => 'ALT_BISE_B_YZ_55_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Sylas, Cryptic Warlock"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Knowledge is power, but secrets are paramount.'),
            'artist' => "Zero Wen",
            'extension' => 'WFTM',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{H} Draw a card.'),
            'supportDesc' => clienttranslate('{I} When you play a Spell — I gain 1 boost, up to a max of 2.'),
            'supportIcon' => 'infinity',
            'forest' => 2,
            'mountain' => 4,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 5,
            'effectHand' => FT::ACTION(DRAW, ['players' => ME]),
            'effectInfinity' => [
                'effectPassive' => [
                    'ChooseAssignment' => [
                        'conditions' => ['isCardPlayed:spell', 'excludeSelf'],
                        'output' => FT::GAIN(ME, BOOST, 1, 2)
                    ],
                ]
            ],
        ];
    }
}

<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_AroroSaviorofAsgartha extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_36_C',
            'asset'  => 'ALT_ALIZE_B_YZ_36_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Aroro, Savior of Asgartha"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Alone, she was able to turn back the tide.'),
            'artist' => "Nestor Papatriantafyllou",
            'extension' => 'TBF',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('{H} You may discard a Spell from your Reserve. If you do, I gain 1 boost.'),
            'forest' => 3,
            'mountain' => 3,
            'ocean' => 4,
            'costHand' => 4,
            'costReserve' => 3,
            'effectHand' => FT::ACTION(
                TARGET,
                [
                    'targetType' => [SPELL],
                    'targetPlayer' => ME,
                    'targetLocation' => [RESERVE],
                    'upTo' => true,
                    'effect' => FT::SEQ(FT::ACTION(DISCARD, []), FT::GAIN(ME, BOOST)),
                ],
                ['optional' => true]
            ),
        ];
    }
}

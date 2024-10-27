<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_FlawedPrototype extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_38_R1',
            'asset'  => 'ALT_ALIZE_B_AX_38_R',

            'faction'  => FACTION_AX,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Flawed Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"If we could just find a substitute for the missing parts, we could make it work."'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{J} Sacrifice another Robot or Permanent. #If its Hand Cost was {3} or more, I gain 3 boosts.# If you can\'t, sacrifice me.'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::XOR(
                FT::XOR(FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'targetType' => [CHARACTER],
                    'subType' => ROBOT,
                    'excludeSelf' => true,
                    'n' => 1,
                    'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                ]), FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'targetType' => [PERMANENT],
                    'excludeSelf' => true,
                    'n' => 1,
                    'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
                ]),),
                FT::ACTION(CHECK_CONDITION, ['condition' => 'noRobotnoPermanent', 'description' => clienttranslate('Sacrifice me'), 'effect' => FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),])
            ),
            // using passive effect to listen to check what was discarded
            'effectPassive' => [
                'Discard' => ['conditions' => ['isSource', 'costCheck:3', 'excludeSelf'], 'output' => FT::GAIN(ME, BOOST, 3)],
            ],
        ];
    }
}

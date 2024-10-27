<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_FlawedPrototype extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_AX_38_R2',
            'asset'  => 'ALT_ALIZE_B_AX_38_R',

            'faction'  => FACTION_MU,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Flawed Prototype"),
            'typeline' => clienttranslate("Character - Robot"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('"If we could just find a substitute for the missing parts, we could make it work."'),
            'artist' => "Zael",
            'extension' => 'TBF',
            'subtypes'  => [ROBOT],
            'effectDesc' => clienttranslate('{J} Sacrifice a #Plant# or Permanent. If you can\'t, sacrifice me.'),
            'forest' => 5,
            'mountain' => 5,
            'ocean' => 5,
            'costHand' => 4,
            'costReserve' => 4,
            'effectPlayed' => FT::XOR(
                FT::XOR(FT::ACTION(TARGET, [
                    'targetPlayer' => ME,
                    'targetType' => [CHARACTER],
                    'subType' => PLANT,
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
                FT::ACTION(CHECK_CONDITION, ['condition' => 'noPlantnoPermanent', 'description' => clienttranslate('Sacrifice me'), 'effect' => FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),])
            )
        ];
    }
}

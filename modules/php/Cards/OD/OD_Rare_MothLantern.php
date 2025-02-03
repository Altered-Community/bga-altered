<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_MothLantern extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_ALIZE_B_YZ_44_R2',
            'asset'  => 'ALT_ALIZE_B_YZ_44_R',

            'faction'  => FACTION_OD,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Moth Lantern"),
            'typeline' => clienttranslate("Expedition Permanent - Gear"),
            'type'  => PERMANENT,
            'flavorText'  => clienttranslate('In the tricks of its light, shed your skin to become an illusion.'),
            'artist' => "HuoMiao Studio",
            'extension' => 'TBF',
            'subtypes'  => [GEAR, EXPEDITION],
            'effectDesc' => clienttranslate('When you sacrifice a non-Illusion Character — Create a <MANA_MOTH> Illusion token in my Expedition.  {J} Sacrifice a Character in my Expedition.'),
            'costHand' => 2,
            'costReserve' => 2,
            'changedStats' => ['costHand'],
            'effectPlayed' => FT::ACTION(TARGET, [
                'targetPlayer' => ME,
                'targetType' => [CHARACTER, TOKEN],
                'targetLocation' => ['source'],
                'effect' => FT::ACTION(DISCARD, ['desc' => 'sacrifice']),
            ]),
            'effectPassive' => [
                'Discard' => [
                    'conditions' => ['isMe', 'isSacrifice:character:illusion:true'],
                    'output' =>  FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'YZ_Common_ManaMoth',
                        'targetLocation' => ['initialSource'],
                    ]),
                ],
            ],

        ];
    }
}

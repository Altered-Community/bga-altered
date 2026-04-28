<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Rare_BaronCimetiere extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_120_R1',
            'asset'  => 'ALT_EOLE_B_YZ_120_R',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_RARE,
            'name'  => clienttranslate("Baron Cimetière"),
            'typeline' => clienttranslate("Character - Mage"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Need someone to slam the door in their faces?'),
            'artist' => "Anh Tung",
            'extension'=>'ROC',
            'subtypes'  => [MAGE],
            'effectDesc' => clienttranslate('#{J}# If six or more cards are in your discard pile, create a <MANA_MOTH> Illusion token in target Expedition. #Otherwise, I gain 1 boost.#'),
            'forest' => 1, 
            'mountain' => 1, 
            'ocean' => 1, 
            'costHand' => 2, 
            'costReserve' => 2,
            'changedStats' => ['costHand', 'forest', 'mountain', 'ocean'],
            'effectPlayed' => FT::ACTION(
                CHECK_CONDITION, [
                    'conditions' => ['hasDiscardPileCards:6'],
                    'effect' => FT::ACTION(INVOKE_TOKEN, [
                        'pId' => 'source',
                        'tokenType' => 'YZ_Common_ManaMoth',
                            'targetLocation' => STORMS,
                        ]),
                    'oppositeEffect' => FT::GAIN(ME, BOOST, 1)
                ])
        ];
    }
}

<?php
namespace ALT\Cards\LY;
use ALT\Helpers\FT;

class LY_Common_Carbunclo extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
                'uid' => 'ALT_EOLE_B_LY_112_C',
            'asset'  => 'ALT_EOLE_B_LY_112_C',

            'faction'  => FACTION_LY,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Carbunclo"),
            'typeline' => clienttranslate("Character - Animal Spirit"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Is that a ruby on its forehead or a burning lump of coal ?'),
            'artist' => "Zero Wen",
            'extension'=>'ROC',
            'subtypes'  => [ANIMAL,SPIRIT],
            'effectDesc' => clienttranslate('{H} If a card in your Expeditions or your Reserve has a {D} ability, <RESUPPLY_LOW>. (Put the top card of your deck in Reserve.)'),
            'forest' => 2, 
            'mountain' => 2, 
            'ocean' => 2, 
            'costHand' => 2, 
            'costReserve' => 2, 
            'effectHand' => FT::ACTION(CHECK_CONDITION, [
                'condition' => 'checkReserveCards:1:hasSupport:discard', 
                'effect' => FT::ACTION(RESUPPLY, [])
            ]),
        ];
    }
}

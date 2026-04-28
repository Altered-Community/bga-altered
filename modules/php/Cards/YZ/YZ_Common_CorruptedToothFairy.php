<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_CorruptedToothFairy extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_108_C',
            'asset'  => 'ALT_EOLE_B_YZ_108_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Corrupted Tooth Fairy"),
            'typeline' => clienttranslate("Character - Corruption Fairy"),
            'type'  => CHARACTER,
            'flavorText'  => clienttranslate('Why muzzle the wolf when you can remove it\'s fangs ?'),
            'artist' => "Nestor Papatriantafyllou",
            'extension'=>'ROC',
            'subtypes'  => [CORRUPTION,FAIRY],
            'effectDesc' => clienttranslate('{H} I gain <FLEETING> unless six or more cards are in your discard pile.  {H} <SABOTAGE>.'),
            'forest' => 1, 
            'mountain' => 2, 
            'ocean' => 1, 
            'costHand' => 2, 
            'costReserve' => 2, 
            'effectHand' => FT::PAR(
                FT::ACTION(CHECK_CONDITION, [
                    'conditions' => ['hasDiscardPileCards:6'],
                    'effect' => FT::GAIN(ME, FLEETING),
                ]),
                FT::ACTION(TARGET, [
                    'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
                    'targetLocation' => [RESERVE],
                    'upTo' => true,
                    'effect' => FT::ACTION(DISCARD, []),
                ]),
            ),
        ];
    }
}

<?php
namespace ALT\Cards\YZ;
use ALT\Helpers\FT;

class YZ_Common_InvestigatetheCorruption extends \ALT\Models\Card
{
    public function __construct($row)
    {
        parent::__construct($row);
        $this->properties = [
            'uid' => 'ALT_EOLE_B_YZ_119_C',
            'asset'  => 'ALT_EOLE_B_YZ_119_C',

            'faction'  => FACTION_YZ,
            'rarity'  => RARITY_COMMON,
            'name'  => clienttranslate("Investigate the Corruption"),
            'typeline' => clienttranslate("Spell - Conjuration"),
            'type'  => SPELL,
            'flavorText'  => clienttranslate('\"By understanding the evil, we can pull it out at the root.\" - Zaj'),
            'artist' => "Nestor Papatriantafyllou",
            'extension'=>'ROC',
            'subtypes'  => [CONJURATION],
            'effectDesc' => clienttranslate('$<FLEETING>.  Draw two cards, then discard a card from your hand.'),
            'costHand' => 2, 
            'costReserve' => 2, 
            'effectPlayed' => FT::SEQ(
                FT::GAIN(ME, FLEETING),
                FT::ACTION(DRAW, ['players' => ME, 'amount' => 2]),
                FT::ACTION(DISCARD, ['source' => HAND]),
            ),
        ];
    }
}
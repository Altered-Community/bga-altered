<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LostintheRiptide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_77_C',
      'asset'  => 'ALT_CYCLONE_B_LY_77_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Lost in the Riptide"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('This is why you\'re supposed to read the map...'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('$<FLEETING>.  You may play me for {1} less. If you do, I can only target a Character in {O}.  Return target Character to the top of its owner\'s deck.'),
      'costHand' => 4,
      'costReserve' => 4,
      'costReductionLimitation' => 1,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck']),
        ])
      ),
      'effectPlayedLimited' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'expeditionAttributes' => [OCEAN],
          'effect' => FT::ACTION(DISCARD, ['destination' => 'topOfDeck']),
        ])
      ),
    ];
  }
}

<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LostintheRiptide extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_77_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_77_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Lost in the Riptide"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('This is why you\'re supposed to read the map...'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Return target Character to the top of its owner\'s deck. #If it was in {O}, ready two Mana Orbs.#'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, ['destination' => 'topOfDeck']),
            FT::ACTION(
              CHECK_CONDITION,
              ['condition' => 'isDiscardedCardInBiome:ocean', 'effect' => FT::SEQ(
                FT::ACTION(READY, ['cardId' => MANA]),
                FT::ACTION(READY, ['cardId' => MANA])
              )]
            )
          )
        ])
      ),
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_LeviathanSpotter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_69_R1',
      'asset'  => 'ALT_CYCLONE_B_BR_69_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Leviathan Spotter"),
      'typeline' => clienttranslate("Character - Messenger"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When the horn sounds, the hunters gather to track the Leviathan.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [MESSENGER],
      'effectDesc' => clienttranslate('{R} You may reveal a Character with Hand Cost {4} or more from your hand. If you do, draw a card.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
      'effectReserve' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'upTo' => true,
        'targetType' => [CHARACTER],
        'minHandCost' => 4,
        'effect' => FT::SEQ(
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'reveal']),
          FT::ACTION(DRAW, ['players' => ME])
        )
      ])
    ];
  }
}

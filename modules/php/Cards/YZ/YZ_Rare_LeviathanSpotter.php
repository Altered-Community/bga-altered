<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_LeviathanSpotter extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_BR_69_R2',
      'asset'  => 'ALT_CYCLONE_B_BR_69_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Leviathan Spotter"),
      'typeline' => clienttranslate("Character - Messenger"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('When the horn sounds, the hunters gather to track the Leviathan.'),
      'artist' => "Justice Wong",
      'extension' => 'SO',
      'subtypes'  => [MESSENGER],
      'effectDesc' => clienttranslate('{R} You may reveal a #Spell# with Hand Cost {4} or more from your hand. If you do, draw a card.'),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'effectReserve' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'upTo' => true,
        'targetType' => [SPELL],
        'minHandCost' => 4,
        'effect' => FT::SEQ(
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'reveal']),
          FT::ACTION(DRAW, ['players' => ME])
        )
      ])
    ];
  }
}

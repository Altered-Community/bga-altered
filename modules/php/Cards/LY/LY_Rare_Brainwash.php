<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Brainwash extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_79_R2',
      'asset'  => 'ALT_CYCLONE_B_YZ_79_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Brainwash"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Like a worm in an apple, Silk squirmed into the Eidolon\'s mind to convert him to its Faction\'s interests.'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Target a Character in any Reserve with Reserve Cost {2} or less. Play it for free. (Put it in one of your Expeditions.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetLocation' => [RESERVE],
          'maxReserveCost' => 2,
          'effect' => FT::ACTION(PLAY_CARD, ['stealOwnership' => true, 'free' => true])
        ])
      )
    ];
  }
}

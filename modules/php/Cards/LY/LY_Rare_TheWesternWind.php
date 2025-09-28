<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_TheWesternWind extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_79_R1',
      'asset'  => 'ALT_CYCLONE_B_LY_79_R',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Western Wind"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('It\'s no use going against the Wind.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('<FLEETING>.  Target Expedition #you control# moves backwards one region. If it does, move your other Expedition forward one region.'),
      'costHand' => 1,
      'costReserve' => 1,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'pId' => ME, 'moveOtherExpedition' => true,])
      ),
    ];
  }
}

<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_TheWesternWind extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_79_C',
      'asset'  => 'ALT_CYCLONE_B_LY_79_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Western Wind"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('It\'s no use going against the Wind.'),
      'artist' => "Kevin Sidharta",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('$<FLEETING>.  Target Expedition moves backwards one region. If it does, its controller moves their other Expedition forward one region.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'moveOtherExpedition' => true,])
      ),
    ];
  }
}

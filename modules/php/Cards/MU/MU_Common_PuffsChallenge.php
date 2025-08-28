<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_PuffsChallenge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_78_C',
      'asset'  => 'ALT_CYCLONE_B_MU_78_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Puff's Challenge"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Wearing red might have been a mistake...'),
      'artist' => "Ba Vo",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('$<FLEETING>.  If an opponent controls three or more Characters, I cost {1} less.  Send target Character to Reserve.'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

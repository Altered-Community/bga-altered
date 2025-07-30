<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Detonation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_75_C',
      'asset'  => 'ALT_CYCLONE_B_AX_75_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Detonation"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Aerolith\'s instability can turn any bump into an explosive reaction.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('$<FLEETING>.  You may sacrifice a Permanent to reduce my cost by {1}.  Send target Character to Reserve.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE()])
      ),
      'costReductionSacrificePermanent' => 1
    ];
  }
}

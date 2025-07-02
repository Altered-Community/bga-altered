<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Detonation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_75_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_75_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Detonation"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('Aerolith\'s instability can turn any bump into an explosive reaction.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  You may sacrifice a Permanent to reduce my cost #by {2}.#  Send to Reserve target Character #with Hand Cost {3} or less.#'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, ['effect' => FT::DISCARD_TO_RESERVE(), 'maxHandCost' => 3])
      ),
      'costReductionSacrificePermanent' => 2
    ];
  }
}

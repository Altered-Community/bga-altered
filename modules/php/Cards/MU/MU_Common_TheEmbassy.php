<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_TheEmbassy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_101_C',
      'asset'  => 'ALT_DUSTER_B_MU_101_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Embassy"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The Reka let the Muna build a natural embassy in the city.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{T}, Target opponent <RESUPPLIES>: The next Character you play this turn with Base Cost {3} or less gains <ANCHORED>. (Reserve Cost if played from Reserve, or Hand Cost if not.)'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectTap' => FT::SEQ(
        FT::ACTION(RESUPPLY, ['player' => 'nextPlayer']),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterBaseCost3Anchored'])
      )
    ];
  }
}

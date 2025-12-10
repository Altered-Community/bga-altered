<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_TheEmbassy extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_101_R1',
      'asset'  => 'ALT_DUSTER_B_MU_101_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Embassy"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The Reka let the Muna build a natural embassy in the city.'),
      'artist' => "HuoMiao Studio",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('#<ANCHORED_CHA_P> and <ASLEEP_CHA_P> Characters you control are <TOUGH_CHA_P_1>.#  {T}, Target opponent <RESUPPLIES>: The next Character you play this turn with Base Cost {3} or less gains <ANCHORED>. (Reserve Cost if played from Reserve, or Hand Cost if not.)'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectTap' => FT::SEQ(
        FT::ACTION(RESUPPLY, ['player' => 'nextPlayer']),
        FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterBaseCost3Anchored'])
      ),
      'dynamicTough' => 'anchoredAndAsleep'
    ];
  }
}

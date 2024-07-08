<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_AxiomScrambler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_15_R2',
      'asset' => 'ALT_CORE_B_AX_15_R',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Axiom Scrambler'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'Pushing back the Tumult sometimes prevents other Alterers from materializing their Eidolons. Regrettable, but necessary.'
      ),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{H} $<SABOTAGE>.'),
      'forest' => 2,
      'mountain' => 4,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 3,
      'effectHand' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, TOKEN, PERMANENT],
        'targetLocation' => [RESERVE],
        'upTo' => true,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}

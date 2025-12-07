<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_CharitableReka extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_MU_89_C',
      'asset'  => 'ALT_DUSTER_B_MU_89_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Charitable Reka"),
      'typeline' => clienttranslate("Character - Citizen"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Opulence is a state of grace that forever teeters on the precipice.'),
      'artist' => "Ba Vo",
      'extension' => 'SDU',
      'subtypes'  => [CITIZEN],
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

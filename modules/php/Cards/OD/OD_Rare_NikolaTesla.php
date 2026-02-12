<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_NikolaTesla extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_89_R2',
      'asset'  => 'ALT_DUSTER_B_AX_89_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Nikola Tesla"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"With this new invention, we can generate a force field to protect the city!"'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{R} I gain 1 boost #per# exhausted Permanent you control and #per# exhausted card in your Reserve, up to a max of 3 boosts on me.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'ocean', 'costHand'],
      'effectReserve' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'boostXExhaustedMax3']),
      'blockAutomaticAction' => [GAIN => [BOOST => 1]]
    ];
  }
}

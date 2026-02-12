<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheConsortium extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_102_R2',
      'asset'  => 'ALT_DUSTER_B_AX_102_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Consortium"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The epicenter of Reka research, focused on perpetual growth.'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} $<RESUPPLY>.  {T} : Target Character in Reserve gains 2 boosts.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'effectTap' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'targetLocation' => [RESERVE],
        'effect' => FT::GAIN(EFFECT, BOOST, 2)
      ])
    ];
  }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_TheConsortium extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_102_C',
      'asset'  => 'ALT_DUSTER_B_AX_102_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("The Consortium"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The epicenter of Reka research, focused on perpetual growth.'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>.  {T} : Target Character in Reserve gains 2 boosts.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
      'effectTap' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER],
        'targetPlayer' => ME,
        'targetLocation' => [RESERVE],
        'effect' => FT::GAIN(EFFECT, BOOST, 2)
      ])
    ];
  }
}

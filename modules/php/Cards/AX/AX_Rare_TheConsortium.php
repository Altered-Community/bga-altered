<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_TheConsortium extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_102_R1',
      'asset'  => 'ALT_DUSTER_B_AX_102_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Consortium"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('The epicenter of Reka research, focused on perpetual growth.'),
      'artist' => "Fahmi Fauzi",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('#{T} : <RESUPPLY>. Then# you may target a Character in Reserve, it gains 2 boosts.'),
      'costHand' => 5,
      'costReserve' => 5,
      'changedStats' => ['costHand', 'costReserve'],
      'effectTap' => FT::SEQ(
        FT::ACTION(RESUPPLY, []),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'targetPlayer' => ME,
          'upTo' => true,
          'targetLocation' => [RESERVE],
          'effect' => FT::GAIN(EFFECT, BOOST, 2)
        ])
      )
    ];
  }
}

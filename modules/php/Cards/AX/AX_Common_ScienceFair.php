<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_ScienceFair extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_100_C',
      'asset'  => 'ALT_DUSTER_B_AX_100_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Science Fair"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('At this convention, the Reka show off their scientific superiority.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{T} : Put a card from your hand in Reserve. If you do, draw a card.'),
      'costHand' => 4,
      'costReserve' => 4,
      'effectTap' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'effect' => FT::SEQ(
          FT::DISCARD_TO_RESERVE(),
          FT::ACTION(DRAW, ['players' => ME])
        )
      ]),
    ];
  }
}

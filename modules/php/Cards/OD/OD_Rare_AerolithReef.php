<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_AerolithReef extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_77_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_77_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Aerolith Reef"),
      'typeline' => clienttranslate("Landmark Permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Reaching the pillar is no easy journey, as the clouds conceal countless reefs and other dangers.'),
      'artist' => "Khoa Viet",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} You may send to Reserve target Character with Hand Cost {2} or less.  #When I\'m sacrificed — <RESUPPLY>.  {T}, {1} : Sacrifice me.#'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['maxHandCost' => 2, 'upTo' => true, 'effect' => FT::DISCARD_TO_RESERVE()]),
      'effectPassive' => [
        'Discard' => [
          'condition' => 'isSacrificed',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
      'effectTap' => FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
    ];
  }
}

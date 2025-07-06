<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_AbandonedDepot extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_79_R2',
      'asset'  => 'ALT_CYCLONE_B_AX_79_R',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Abandoned Depot"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"There\'s no doubt about it... These ruins are the work of people from the City of Scholars." - Abiram'),
      'artist' => "Taras Susak",
      'extension' => 'SO',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} Draw a card.  When I\'m sacrificed — #<RESUPPLY>.# (Excess Landmarks are sacrificed at the end of the Day.)  {T}, {1} : Sacrifice me.'),
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
      'effectPlayed' => FT::ACTION(DRAW, ['players' => ME]),
      'effectPassive' => [
        'Discard' => [
          'condition' => 'isSacrificed',
          'output' => FT::ACTION(RESUPPLY, []),
        ],
      ],
      'effectTap' => FT::SEQ(
        FT::ACTION(PAY, ['pay' => 1]),
        FT::ACTION(DISCARD, ['cardId' => ME, 'desc' => 'sacrifice']),
      )
    ];
  }
}

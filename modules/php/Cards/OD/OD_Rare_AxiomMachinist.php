<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_AxiomMachinist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_AX_87_R2',
      'asset'  => 'ALT_DUSTER_B_AX_87_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Axiom Machinist"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('From Kelon to Sap to Manaseed, the Axiom never stop experimenting with alternative energy sources.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SDU',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('#{J}# You may ready target Permanent in play or target card in Reserve.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costReserve'],
      'effectPlayed' => FT::XOR(
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT],
          'upTo' => true,
          'effect' => FT::ACTION(READY, ['cardId' => EFFECT])
        ]),
        FT::ACTION(TARGET, [
          'targetType' => [PERMANENT, CHARACTER, SPELL],
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::ACTION(READY, ['cardId' => EFFECT])
        ])

      )
    ];
  }
}

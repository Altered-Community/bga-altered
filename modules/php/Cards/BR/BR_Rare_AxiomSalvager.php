<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_AxiomSalvager extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_08_R2',
      'asset' => 'ALT_CORE_B_AX_08_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Axiom Salvager'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('The Axiom\'s limited resources pushed them to reuse whatever they could.'),
      'artist' => 'Anh Tung',
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{R} $<RESUPPLY>.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 2,
      'effectReserve' => FT::ACTION(RESUPPLY, []),
    ];
  }
}

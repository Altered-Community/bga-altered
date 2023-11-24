<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_AxiomSalvager extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_08_C',
      'asset' => 'ALT_CORE_B_AX_08_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Axiom Salvager'),
      'type' => CHARACTER,
      'subtype' => ENGINEER,
      'effectDesc' => clienttranslate('{S} $[RESUPPLY].  '),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
      'effectReserve' => FT::ACTION(RESUPPLY, []),
    ];
  }
}

<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_Mandjet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_81_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_81_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mandjet"),
      'typeline' => clienttranslate("Landmark Permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Mandjet and Mesektet, the Ordis flagships, reunited at last.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{T}: Target Expedition <ASCENDS>.  #If one of your Ascended Expeditions would attempt to <ASCEND_INF> again, <RESUPPLY_LOW> instead.#'),
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
      'effectTap' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend', 'resupplyIfAscended' => true])])

    ];
  }
}

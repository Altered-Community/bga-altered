<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Rare_Mandjet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_81_R2',
      'asset'  => 'ALT_CYCLONE_B_OR_81_R',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Mandjet"),
      'typeline' => clienttranslate("Landmark Permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Mandjet and Mesektet, the Ordis flagships, reunited at last.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{T}: Target Expedition <ASCENDS>.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectTap' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])])
    ];
  }
}

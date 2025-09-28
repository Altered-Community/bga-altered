<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Mandjet extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_81_C',
      'asset'  => 'ALT_CYCLONE_B_OR_81_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Mandjet"),
      'typeline' => clienttranslate("Landmark Permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Mandjet and Mesektet, the Ordis flagships, reunited at last.'),
      'artist' => "Anh Tung",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{T}: Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectTap' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])])
    ];
  }
}

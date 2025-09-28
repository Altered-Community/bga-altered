<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_TheOrigamium extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_82_R1',
      'asset'  => 'ALT_CYCLONE_B_OR_82_R',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("The Origamium"),
      'typeline' => clienttranslate("Landmark Permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Where paper heralds take flight.'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{J} Target Expedition <ASCENDS>.  #{T}: #Target Character in an Ascended Expedition gains 1 boost.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])]),
      'effectTap' => FT::ACTION(TARGET, ['ascendedOnly' => true, 'effect' => FT::GAIN(EFFECT, BOOST)])

    ];
  }
}

<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Rare_KakobaLegionCommander extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_15_R1',
      'asset' => 'ALT_CORE_B_OR_15_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kakoba, Legion Commander'),
      'type' => CHARACTER,
      'subtypes' => [SOLDIER],
      'effectDesc' => clienttranslate('{J} If you have at least 3 other Characters in your Expeditions, I gain #3# boosts.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
      'effectPlayed' => FT::ACTION(CHECK_CONDITION, [
        'condition' => 'control3OtherCharacters',
        'effect' => FT::GAIN(ME, BOOST, 3),
      ]),
    ];
  }
}

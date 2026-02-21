<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_EmergencyBurst extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_118_R2',
      'asset'  => 'ALT_EOLE_B_AX_118_R',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Emergency Burst"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
      'extension' => 'ROC',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Play me for {1} less if there are no other cards in your hand.  #Discard# target Character #or Permanent# with Base Cost #{2} or less.#'),
      'costHand' => 3,
      'costReserve' => 3,
      'dynamicCostReduction' => '1:hasXCardsInHand:0:LTE',
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, PERMANENT],
          'maxBaseCost' => 2,
          'effect' => FT::ACTION(DISCARD, []),
        ]),
      ),
    ];
  }
}

<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_EmergencyBurst extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_118_C',
      'asset'  => 'ALT_EOLE_B_AX_118_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Emergency Burst"),
      'typeline' => clienttranslate("Spell - Disruption"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate(''),
      'artist' => "Khoa Viet",
      'extension' => 'ROC',
      'subtypes'  => [DISRUPTION],
      'effectDesc' => clienttranslate('<FLEETING>.  Play me for {1} less if there are no other cards in your hand.  Send to Reserve target Character with Base Cost {3} or less. (Reserve Cost if it\'s Fleeting, Hand Cost if not.)'),
      'costHand' => 3,
      'costReserve' => 3,
      'dynamicCostReduction' => '1:hasXCardsInHand:1:LTE',
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER],
          'upTo' => true,
          'maxBaseCost' => 3,
          'effect' => FT::DISCARD_TO_RESERVE(),
        ])
      ),
    ];
  }
}

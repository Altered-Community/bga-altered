<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_CableCarStation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_LY_102_C',
      'asset'  => 'ALT_DUSTER_B_LY_102_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Cable-Car Station"),
      'typeline' => clienttranslate("Landmark_permanent - Site"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('Reka cable-cars are the safest way to get around the city.'),
      'artist' => "Anh Tung",
      'extension' => 'SDU',
      'subtypes'  => [SITE, LANDMARK],
      'effectDesc' => clienttranslate('{J} <RESUPPLY>, then I gain 2 Move counters.  {T}, Spend 1 of my Move counters: One of your Expeditions moves backwards one region. If it does, your other Expedition moves forward one region.'),
      'costHand' => 2,
      'costReserve' => 2,
      'effectPlayed' => FT::SEQ(
        FT::ACTION(RESUPPLY, []),
        FT::ACTION(SPECIAL_EFFECT, [
          'effect' => 'gainCounter',
          'args' => ['counter' => 2, 'counterName' => clienttranslate('Move counters')],
        ]),
      ),
      'effectTap' => FT::SEQ(
        FT::ACTION(USE_COUNTER, ['consume' => 1], ['sourceId' => $this->id]),
        FT::ACTION(TARGET_EXPEDITION, ['players' => ME, 'effect' => FT::ACTION(MOVE_EXPEDITION, ['n' => -1, 'pId' => ME, 'moveOtherExpedition' => true])])
      )
    ];
  }
}

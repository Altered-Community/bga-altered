<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_RestockingStation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_AX_81_C',
      'asset'  => 'ALT_CYCLONE_B_AX_81_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Restocking Station"),
      'typeline' => clienttranslate("Landmark Permanent - Construction"),
      'type'  => PERMANENT,
      'flavorText'  => clienttranslate('"Kelon powers our engines, aerolith gives us access to the skies. What heights will we reach with the other two Primordiae?" - Basem'),
      'artist' => "Jean-Baptiste Andrier",
      'extension' => 'SO',
      'subtypes'  => [CONSTRUCTION, LANDMARK],
      'effectDesc' => clienttranslate('{J} I gain 2 Kelon counters.  {T}, Spend 1 of my Kelon counters: target Character loses <FLEETING>.'),
      'costHand' => 1,
      'costReserve' => 1,
      'effectPlayed' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'gainCounter', 'args' => ['counter' => 2, 'counterName' => clienttranslate('Kelon counter')]],
      ],
      'effectTap' => FT::SEQ(
        FT::ACTION(USE_COUNTER, ['consume' => 1]),
        FT::ACTION(
          TARGET,
          [
            'targetType' => [CHARACTER, TOKEN],
            'effect' => FT::LOOSE(EFFECT, FLEETING)
          ]
        )
      )
    ];
  }
}

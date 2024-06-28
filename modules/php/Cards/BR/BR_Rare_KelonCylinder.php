<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;


class BR_Rare_KelonCylinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_26_R2',
      'asset' => 'ALT_CORE_B_AX_26_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Kelon Cylinder',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
      'This little battery is Axiom\'s trump card. The Kelon produces phenomenal energy for which engineers find new applications every day.',
      'artist' => 'Anh Tung',
      'subtypes' => [LANDMARK],
      'effectDesc' =>
      '{T} : I gain two Kelon counters.  {T}, Spend one of my Kelon counters: the next Character you play this turn gains 1 boost.',
      'costHand' => 1,
      'costReserve' => 1,
      'effectTap' => FT::XOR(
        FT::ACTION(SPECIAL_EFFECT, [
          'effect' => 'gainCounter',
          'args' => ['counter' => 2, 'counterName' => clienttranslate('Kelon counters')],
        ]),
        FT::SEQ(
          FT::ACTION(USE_COUNTER, ['consume' => 1], ['sourceId' => $this->id]),
          FT::ACTION(SPECIAL_EFFECT, ['effect' => 'nextCharacterGains1Boost'])
        )
      ),
    ];
  }
}

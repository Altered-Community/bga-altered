<?php
namespace ALT\Cards\AX;

class AX_Common_KelonCylinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_26_C',
      'asset' => 'ALT_CORE_B_AX_26_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Kelon Cylinder',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' =>
        'This little battery is Axiom\'s trump card. The Kelon produces phenomenal energy for which engineers find new applications every day.',
      'artist' => 'Anh Tung',
      'subtypes' => [LANDMARK],
      'effectDesc' =>
        '{T} : I gain two Kelon counters.  {T}, Spend one of my Kelon counters: the next Character you play this turn gains 1 boost$<BB>.',
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

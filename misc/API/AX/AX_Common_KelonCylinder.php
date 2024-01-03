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
      'name' => clienttranslate('Kelon Cylinder'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate(
        'This little battery is Axiom\'s trump card. The Kelon produces phenomenal energy, for which engineers find new applications every day.'
      ),
      'effectDesc' => clienttranslate(
        '{T} : I gain two Kelon counters.  {T}, Spend one of my Kelon counters: the next Character you play this turn gains 1 boost[]. (A boost is a +1/+1/+1 counter. Remove it when it leaves the Expedition zone.)'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

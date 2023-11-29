<?php
namespace ALT\Cards\BR;

class BR_Rare_KelonCylinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_26_R2',
      'asset' => 'ALT_CORE_B_AX_26_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelon Cylinder'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{T} : I gain two Kelon Counters.  {T}, Spend one of my Kelon counters: the next Character you play this turn gains 1 boost.'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

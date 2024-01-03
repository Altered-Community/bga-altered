<?php
namespace ALT\Cards\AX;

class AX_Rare_KelonCylinder extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_26_R1',
      'asset' => 'ALT_CORE_B_AX_26_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelon Cylinder'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '#{J} Target Character gains 1 boost.#  {T} : I gain two Kelon counters.  {T}, Spend one of my Kelon counters: #target Character gains 1 boost.#'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

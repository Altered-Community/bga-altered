<?php
namespace ALT\Cards\AX;

class AX_Common_Hooked extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_20_C',
      'asset' => 'ALT_CORE_B_AX_20_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hooked'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'flavorText' => clienttranslate('Get over here!'),
      'effectDesc' => clienttranslate(
        'Target Character switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'
      ),
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

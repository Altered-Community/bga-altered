<?php
namespace ALT\Cards\AX;

class AX_Rare_Hooked extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_20_R1',
      'asset' => 'ALT_CORE_B_AX_20_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Hooked'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        'Target Character switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)  Draw a card.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

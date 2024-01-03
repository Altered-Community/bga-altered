<?php
namespace ALT\Cards\AX;

class AX_Rare_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_R2',
      'asset' => 'ALT_CORE_B_OR_26_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Open the Gates'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate('Create a [Brassbug 2/2/2] Robot token in each of your Expeditions.'),
      'costHand' => 4,
      'costReserve' => 5,
    ];
  }
}

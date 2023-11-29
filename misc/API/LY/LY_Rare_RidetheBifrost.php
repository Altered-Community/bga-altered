<?php
namespace ALT\Cards\LY;

class LY_Rare_RidetheBifrost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_28_R1',
      'asset' => 'ALT_CORE_B_LY_28_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ride the Bifrost'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. All Characters target opponent controls switch Expeditions. (They leave their Expeditions and join their controller\'s other Expeditions.) (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

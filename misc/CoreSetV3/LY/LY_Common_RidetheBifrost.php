<?php
namespace ALT\Cards\LY;

class LY_Common_RidetheBifrost extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_28_C',
      'asset' => 'ALT_CORE_B_LY_28_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Ride the Bifröst',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' => 'The Lyra never play by the rules.',
      'artist' => 'Fahmi Fauzi',
      'subtypes' => [MANEUVER],
      'effectDesc' =>
        '$[FLEETING].  All Characters you control switch Expeditions. (They leave their Expeditions and join their controller\'s other Expedition.)',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

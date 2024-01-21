<?php
namespace ALT\Cards\OD;

class OD_Common_OpentheGates extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_26_C',
      'asset' => 'ALT_CORE_B_OR_26_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Open the Gates',
      'typeline' => 'Spell - Maneuver',
      'type' => SPELL,
      'flavorText' =>
        'For the first time in centuries, the Solstice Gate has opened. For the first time in ages, humanity will discover what lies beyond the gates.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [MANEUVER],
      'effectDesc' => 'Create two [ORDIS_RECRUIT] Soldier tokens in each of your Expeditions.',
      'costHand' => 5,
      'costReserve' => 6,
    ];
  }
}

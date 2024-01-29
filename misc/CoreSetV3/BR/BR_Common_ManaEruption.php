<?php
namespace ALT\Cards\BR;

class BR_Common_ManaEruption extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_29_C',
      'asset' => 'ALT_CORE_B_BR_29_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Mana Eruption',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Flames fly from his hand as he falls towards the monster, leaving a trail of glowing fire behind him...',
      'artist' => 'Zero Wen',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Discard one of your Mana Orbs. If you do, discard target Character or Permanent.',
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\LY;

class LY_Common_ACappellaTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_22_C',
      'asset' => 'ALT_CORE_B_LY_22_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'A Cappella Training',
      'typeline' => 'Spell - Song',
      'type' => SPELL,
      'flavorText' => 'Thank you for being my metronome!',
      'artist' => 'Zero Wen',
      'subtypes' => [SONG],
      'effectDesc' => 'Target Character gains [FLEETING_CHAR]. (If it would be sent to Reserve, discard it instead.)',
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

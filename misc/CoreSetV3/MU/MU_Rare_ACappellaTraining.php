<?php
namespace ALT\Cards\MU;

class MU_Rare_ACappellaTraining extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_22_R2',
      'asset' => 'ALT_CORE_B_LY_22_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
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

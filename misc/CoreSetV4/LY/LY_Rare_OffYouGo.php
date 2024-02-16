<?php
namespace ALT\Cards\LY;

class LY_Rare_OffYouGo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_21_R2',
      'asset' => 'ALT_CORE_B_YZ_21_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Off You Go!',
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' => 'Time to kiss Kansas goodbye.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [DISRUPTION],
      'effectDesc' => 'Send to Reserve target Character with Hand Cost {3} or less.',
      'costHand' => 2,
      'costReserve' => 4,
    ];
  }
}

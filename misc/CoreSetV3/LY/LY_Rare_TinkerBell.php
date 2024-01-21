<?php
namespace ALT\Cards\LY;

class LY_Rare_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_09_R2',
      'asset' => 'ALT_CORE_B_AX_09_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Tinker Bell',
      'typeline' => 'Character - Fairy',
      'type' => CHARACTER,
      'flavorText' => "Ting! Ting-a-ling! There\'s something magical in mischievous tinkering...",
      'artist' => 'Anh Tung',
      'subtypes' => [FAIRY],
      'effectDesc' => '{R} $[SABOTAGE].',
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costHand'],
    ];
  }
}

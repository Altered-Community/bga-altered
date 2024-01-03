<?php
namespace ALT\Cards\AX;

class AX_Rare_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_09_R1',
      'asset' => 'ALT_CORE_B_AX_09_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tinker Bell'),
      'typeline' => clienttranslate('Character - Fairy'),
      'type' => CHARACTER,
      'subtypes' => [FAIRY],
      'flavorText' => clienttranslate('Ting! Ting-a-ling! There\'s something magical in mischievous tinkering...'),
      'effectDesc' => clienttranslate('{R} $[SABOTAGE].'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 3,
      'changedStats' => ['costHand'],
    ];
  }
}

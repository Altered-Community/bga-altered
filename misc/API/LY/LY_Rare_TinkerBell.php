<?php
namespace ALT\Cards\LY;

class LY_Rare_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_09_R2',
      'asset' => 'ALT_CORE_B_AX_09_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tinker Bell'),
      'typeline' => clienttranslate('Character - Fairy'),
      'type' => CHARACTER,
      'subtypes' => [FAIRY],
      'flavorText' => clienttranslate('Ting! Ting-a-ling! There\'s something magical in mischievous tinkering...'),
      'effectDesc' => clienttranslate('{R} [Sabotage]. (Discard up to one target card from a Reserve.)'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

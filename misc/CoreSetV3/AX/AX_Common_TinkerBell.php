<?php
namespace ALT\Cards\AX;

class AX_Common_TinkerBell extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_09_C',
      'asset' => 'ALT_CORE_B_AX_09_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Tinker Bell',
      'typeline' => 'Character - Fairy',
      'type' => CHARACTER,
      'flavorText' => 'Ting! Ting-a-ling! There\'s something magical in mischievous tinkering...',
      'artist' => 'Anh Tung',
      'subtypes' => [FAIRY],
      'effectDesc' => '{R} $<SABOTAGE>.',
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

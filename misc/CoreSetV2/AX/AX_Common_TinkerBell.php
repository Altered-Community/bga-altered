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
      'name' => clienttranslate('Tinker Bell'),
      'typeline' => clienttranslate('Character - Fairy'),
      'type' => CHARACTER,
      'subtypes' => [FAIRY],
      'effectDesc' => clienttranslate('{R} $[SABOTAGE].'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

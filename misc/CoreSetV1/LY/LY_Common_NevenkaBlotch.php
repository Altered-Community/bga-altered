<?php
namespace ALT\Cards\LY;

class LY_Common_NevenkaBlotch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_01_C',
      'asset' => 'ALT_CORE_B_LY_01_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Nevenka & Blotch'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        '{T} : Target one of your Characters, then roll a die.  - On 6, it becomes $[ANCHORED].  - On 1, send it to Reserve.  - Otherwise it gains 1 boost.  '
      ),
    ];
  }
}

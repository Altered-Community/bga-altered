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
      'typeline' => clienttranslate('Lyra Hero'),
      'type' => HERO,
      'flavorText' => clienttranslate(
        "Chaos can bring disappointment, sure, but it's also where ye'll find the most wonderfullest hidden gems!"
      ),
      'artist' => 'Edward Cheekokseang',
      'effectDesc' => clienttranslate(
        '{T} : Target a Character you control, then roll a die. On a:  • 6+, it gains [ANCHORED]. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)  • 2-5, it gains 1 boost$[BB].  • 1, send it to Reserve.'
      ),
    ];
  }
}

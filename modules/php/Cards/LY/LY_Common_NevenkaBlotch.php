<?php
namespace ALT\Cards\LY;

class LY_Common_NevenkaBlotch extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '68',
      'asset' => 'LY-03-Nevenka-Blotch',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('Nevenka & Blotch'),
      'typeline' => clienttranslate('Lyra Hero'),
      'rarity' => RARITY_COMMON,
      'type' => HERO,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '{T} : Target an allied Character, then roll a die.  - On 6, it becomes [[Anchored]].  - On 1, send it to Reserve.  - Otherwise, it gains 1 boost.'
      ),
    ];
  }
}

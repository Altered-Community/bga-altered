<?php
namespace ALT\Cards\MU;

class MU_Common_TeijaNauraa extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_01_C',
      'asset' => 'ALT_CORE_B_MU_01_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Teija & Nauraa'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate('The first Character you play each Afternoon gains 1 boost.'),
    ];
  }
}

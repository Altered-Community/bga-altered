<?php
namespace ALT\Cards\AX;

class AX_Common_TreystRossum extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_02_C',
      'asset' => 'ALT_CORE_B_AX_02_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Treyst & Rossum'),
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When a card leaves your Reserve during the Afternoon, if I have less than five Steam counters — I gain a Steam counter.  If I have five or more Steam counters, I gain \"{T} : Draw a card then put a card from your hand in your Reserve.\"'
      ),
    ];
  }
}

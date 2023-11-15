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
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When a card leaves your Reserve during the Afternoon, if I have less than 5 Steam counters, add me one.  {T} : Draw a card then put a card from your hand in Reserve. Activate this ability only if I have at least 5 Steam counters.  '
      ),
    ];
  }
}

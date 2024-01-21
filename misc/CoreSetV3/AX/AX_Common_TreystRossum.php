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
      'name' => 'Treyst & Rossum',
      'typeline' => 'Hero',
      'type' => HERO,
      'flavorText' => 'An energy system is a piece of subtle machinery to be optimized for better output.',
      'artist' => 'Taras Susak',
      'effectDesc' =>
        'When a card leaves your Reserve during the Afternoon, if I have less than five Scrap counters — I gain a Scrap counter.  If I have five or more Scrap counters, I gain \"{T} : Draw a card, then put a card from your hand in Reserve.\"',
    ];
  }
}

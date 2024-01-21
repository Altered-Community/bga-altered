<?php
namespace ALT\Cards\LY;

class LY_Common_AuraqKibble extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_02_C',
      'asset' => 'ALT_CORE_B_LY_02_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Auraq & Kibble',
      'typeline' => 'Hero',
      'type' => HERO,
      'flavorText' => 'True beauty lies outside of the conventional.',
      'artist' => 'Edward Cheekokseang',
      'effectDesc' =>
        'When you play a Character with a base statistic of 0 — I gain a Performance counter.  At Noon — You may spend five of my Performance counters to reveal the top card of your deck. You may play it for free or put it into your hand. (Don\'t activate any {h} triggers.)',
    ];
  }
}

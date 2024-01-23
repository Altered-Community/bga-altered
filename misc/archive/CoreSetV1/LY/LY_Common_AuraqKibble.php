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
      'name' => clienttranslate('Auraq & Kibble'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'Whenever you play a card with a base statistic 0 — I gain a Performance Counter.  At Dawn — you may remove 5 Performance Counters from me to reveal the top card of your deck. You may play it for free. If you don\'t, put it into your hand. (Don\'t trigger any {M} effects.)'
      ),
    ];
  }
}

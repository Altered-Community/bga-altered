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
      'typeline' => 'Lyra Hero',
      'type' => HERO,
      'flavorText' => 'True beauty lies outside of the conventional.',
      'artist' => 'Edward Cheekokseang',
    ];
  }
}

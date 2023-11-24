<?php
namespace ALT\Cards\OD;

class OD_Common_GulrangTocsin extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_03_C',
      'asset' => 'ALT_CORE_B_OR_03_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Gulrang & Tocsin'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'Whenever you create a token — it gains 1 boost.  As long as you have less than 8 Mana Orbs, your boosted tokens have $[DEFENDER].'
      ),
    ];
  }
}

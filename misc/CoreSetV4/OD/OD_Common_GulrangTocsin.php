<?php
namespace ALT\Cards\OD;

class OD_Common_GulrangTocsin extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_OR_03_C',
      'asset' => 'ALT_CORE_P_OR_03_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Gulrang & Tocsin',
      'typeline' => 'Ordis Hero',
      'type' => HERO,
      'flavorText' => 'MISSING FLAVOR',
      'artist' => 'MISSING ARTIST',
      'effectDesc' =>
        'When you create a token — It gains 1 boost.  If you have less than eight Mana Orbs, <BOOSTED_TKN_P> tokens you control have <DEFENDER>. (Their Expeditions can\'t advance during Dusk.)',
    ];
  }
}

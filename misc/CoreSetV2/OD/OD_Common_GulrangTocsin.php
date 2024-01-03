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
      'typeline' => clienttranslate('Hero'),
      'type' => HERO,
      'effectDesc' => clienttranslate(
        'When you create a token — It gains 1 boost.  If you have less than eight Mana Orbs, [BOOSTED] tokens you control have [DEFENDER]. (Their Expeditions can\'t advance during Dusk.)'
      ),
    ];
  }
}

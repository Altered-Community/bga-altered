<?php
namespace ALT\Cards\AX;

class AX_Common_SubhashMarmo extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_P_AX_03_C',
      'asset' => 'ALT_CORE_P_AX_03_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Subhash & Marmo',
      'typeline' => 'Axiom Hero',
      'type' => HERO,
      'flavorText' => 'MISSING FLAVOR',
      'artist' => 'MISSING ARTIST',
    ];
  }
}

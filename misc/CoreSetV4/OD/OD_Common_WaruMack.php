<?php
namespace ALT\Cards\OD;

class OD_Common_WaruMack extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_02_C',
      'asset' => 'ALT_CORE_B_OR_02_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => 'Waru & Mack',
      'typeline' => 'Ordis Hero',
      'type' => HERO,
      'flavorText' => 'Bureaucracy is an art that requires careful planning.',
      'artist' => 'Taras Susak',
    ];
  }
}

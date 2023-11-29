<?php
namespace ALT\Cards\MU;

class MU_Common_MagicalSeeds extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_24_C',
      'asset' => 'ALT_CORE_B_MU_24_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Magical Seeds'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('{T} : The next Plant you play this turn costs {1} less.'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

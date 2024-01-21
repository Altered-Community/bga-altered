<?php
namespace ALT\Cards\MU;

class MU_Common_BountifulMeadow extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_24_C',
      'asset' => 'ALT_CORE_B_MU_24_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Bountiful Meadow',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => "There\'s no greater joy than seeing all that is green thrive and grow.",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{T} : The next Plant you play this turn costs {1} less.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

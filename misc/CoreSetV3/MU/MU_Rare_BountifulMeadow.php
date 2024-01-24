<?php
namespace ALT\Cards\MU;

class MU_Rare_BountifulMeadow extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_24_R1',
      'asset' => 'ALT_CORE_B_MU_24_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Bountiful Meadow',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => "There's no greater joy than seeing all that is green thrive and grow.",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '#{J} You may pay {1} to $[RESUPPLY].#  {T} : The next Plant you play this turn costs {1} less.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

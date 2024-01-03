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
      'name' => clienttranslate('Bountiful Meadow'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate(
        '{J} You may pay {1} to [Resupply]. (Put the top card of your deck in Reserve.)  {T} : The next Plant you play this turn costs {1} less.'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

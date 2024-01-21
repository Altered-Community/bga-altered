<?php
namespace ALT\Cards\OD;

class OD_Rare_BountifulMeadow extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_24_R2',
      'asset' => 'ALT_CORE_B_MU_24_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Bountiful Meadow',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => "There\'s no greater joy than seeing all that is green thrive and grow.",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{T} : The next #Bureaucrat# you play this turn costs {1} less.',
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

<?php
namespace ALT\Cards\OD;

class OD_Rare_BountifulMeadow extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_24_R2',
      'asset' => 'ALT_CORE_B_MU_24_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Bountiful Meadow'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('{T} : The next #Bureaucrat# you play this turn costs {1} less.'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

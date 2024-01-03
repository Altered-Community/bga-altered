<?php
namespace ALT\Cards\YZ;

class YZ_Rare_YzmirStargazer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_08_R1',
      'asset' => 'ALT_CORE_B_YZ_08_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Yzmir Stargazer'),
      'typeline' => clienttranslate('Character - Mage Scholar'),
      'type' => CHARACTER,
      'subtypes' => [MAGE, SCHOLAR],
      'effectDesc' => clienttranslate('#When I\'m sacrificed — You may have target Character gain 2 boosts$[BB].#'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'water', 'costReserve'],
    ];
  }
}

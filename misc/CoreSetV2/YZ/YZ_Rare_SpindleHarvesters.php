<?php
namespace ALT\Cards\YZ;

class YZ_Rare_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_R2',
      'asset' => 'ALT_CORE_B_MU_06_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Spindle Harvesters'),
      'typeline' => clienttranslate('Character - Plant Animal'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, ANIMAL],
      'effectDesc' => clienttranslate('{J} I gain $[ANCHORED].'),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

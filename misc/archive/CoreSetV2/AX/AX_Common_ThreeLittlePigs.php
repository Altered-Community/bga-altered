<?php
namespace ALT\Cards\AX;

class AX_Common_ThreeLittlePigs extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_12_C',
      'asset' => 'ALT_CORE_B_AX_12_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Three Little Pigs'),
      'typeline' => clienttranslate('Character - Engineer'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'flavorText' => clienttranslate('Together they can build more than just a stone house.'),
      'effectDesc' => clienttranslate(
        '{J} If you control two or more Landmarks, I gain 1 boost$[BB]. (Cards in Reserve are not controlled.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

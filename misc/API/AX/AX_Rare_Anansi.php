<?php
namespace ALT\Cards\AX;

class AX_Rare_Anansi extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_13_R2',
      'asset' => 'ALT_CORE_B_LY_13_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Anansi'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate('{J} I gain 1 boost for each card in your Reserve.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\AX;

class AX_Rare_Mowgli extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_07_R2',
      'asset' => 'ALT_CORE_B_MU_07_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Mowgli'),
      'typeline' => clienttranslate('Character - Druid'),
      'type' => CHARACTER,
      'subtypes' => [DRUID],
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}

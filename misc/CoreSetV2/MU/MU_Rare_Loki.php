<?php
namespace ALT\Cards\MU;

class MU_Rare_Loki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_21_R2',
      'asset' => 'ALT_CORE_B_LY_21_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Loki'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{H} Each player discards their hand, then draws three cards.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 5,
    ];
  }
}

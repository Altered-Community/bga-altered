<?php
namespace ALT\Cards\MU;

class MU_Rare_Ganesha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_19_R2',
      'asset' => 'ALT_CORE_B_AX_19_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Ganesha',
      'typeline' => 'Character - Deity',
      'type' => CHARACTER,
      'flavorText' => 'Knowledge and wisdom must walk side by side.',
      'artist' => 'Taras Susak',
      'subtypes' => [DEITY],
      'effectDesc' => '{J} For each #other Character# you control, you may activate its {j} triggers.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}

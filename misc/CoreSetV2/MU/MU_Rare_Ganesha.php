<?php
namespace ALT\Cards\MU;

class MU_Rare_Ganesha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_19_R2',
      'asset' => 'ALT_CORE_B_AX_19_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ganesha'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'flavorText' => clienttranslate('Knowledge and wisdom must walk side by side.'),
      'effectDesc' => clienttranslate('{J} For each #other Character# you control, you may activate its {j} triggers.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}

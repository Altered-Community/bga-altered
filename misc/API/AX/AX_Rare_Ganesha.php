<?php
namespace ALT\Cards\AX;

class AX_Rare_Ganesha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_19_R1',
      'asset' => 'ALT_CORE_B_AX_19_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ganesha'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'flavorText' => clienttranslate('Knowledge and wisdom must walk side by side.'),
      'effectDesc' => clienttranslate('{J} For each Permanent you control, you may activate its {j} triggers.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

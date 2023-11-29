<?php
namespace ALT\Cards\MU;

class MU_Rare_KelonElemental extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_04_R2',
      'asset' => 'ALT_CORE_B_AX_04_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelon Elemental'),
      'typeline' => clienttranslate('Character - Elemental'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate('{J} You may put a card from your hand in your Reserve.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

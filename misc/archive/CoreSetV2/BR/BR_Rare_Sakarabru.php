<?php
namespace ALT\Cards\BR;

class BR_Rare_Sakarabru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_18_R2',
      'asset' => 'ALT_CORE_B_YZ_18_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sakarabru'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{H} Your opponent\'s Expedition facing mine moves backwards one region.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 7,
      'costReserve' => 4,
    ];
  }
}

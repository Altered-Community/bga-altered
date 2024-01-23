<?php
namespace ALT\Cards\MU;

class MU_Rare_Cernunnos extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_14_R1',
      'asset' => 'ALT_CORE_B_MU_14_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Cernunnos'),
      'typeline' => clienttranslate('Character - Druid Deity'),
      'type' => CHARACTER,
      'subtypes' => [DRUID, DEITY],
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand'],
    ];
  }
}

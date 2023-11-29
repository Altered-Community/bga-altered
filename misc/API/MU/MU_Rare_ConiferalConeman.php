<?php
namespace ALT\Cards\MU;

class MU_Rare_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_20_R1',
      'asset' => 'ALT_CORE_B_MU_20_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Coniferal Coneman'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate('{J} I gain [[Anchored]]. (At Night, I don\'t go to Reserve and I lose Anchored.)'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

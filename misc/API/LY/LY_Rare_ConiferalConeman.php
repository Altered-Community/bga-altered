<?php
namespace ALT\Cards\LY;

class LY_Rare_ConiferalConeman extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_20_R2',
      'asset' => 'ALT_CORE_B_MU_20_R2',

      'faction' => FACTION_LY,
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

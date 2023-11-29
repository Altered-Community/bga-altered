<?php
namespace ALT\Cards\LY;

class LY_Rare_AloeVera extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_16_R2',
      'asset' => 'ALT_CORE_B_MU_16_R2',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Aloe Vera'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate(
        '{J} You may pay {1} to have me gain [[Anchored]].  At Noon — [Resupply]. (At Night, I don\'t go to Reserve and I lose Anchored.Put the top card of your deck in your Reserve.)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

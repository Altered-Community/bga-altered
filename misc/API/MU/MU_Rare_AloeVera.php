<?php
namespace ALT\Cards\MU;

class MU_Rare_AloeVera extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_16_R1',
      'asset' => 'ALT_CORE_B_MU_16_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Aloe Vera'),
      'typeline' => clienttranslate('Character - Plant'),
      'type' => CHARACTER,
      'subtypes' => [PLANT],
      'effectDesc' => clienttranslate(
        '{J} You may pay {1} to have me gain [[Anchored]]. (During Rest, I don\'t go to Reserve and I lose Anchored.)  At Noon — [Resupply]. (Put the top card of your deck in Reserve.)'
      ),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

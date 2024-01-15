<?php
namespace ALT\Cards\MU;

class MU_Rare_SpindleHarvesters extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_06_R1',
      'asset' => 'ALT_CORE_B_MU_06_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Spindle Harvesters'),
      'typeline' => clienttranslate('Character - ANIMAL'),
      'type' => CHARACTER,
      'subtypes' => [ANIMAL],
      'effectDesc' => clienttranslate(
        '{J} I gain [[Anchored]]. (During Rest, I don\'t go to Reserve and I lose Anchored.)  At Noon, if I have 2 or more boosts — [Resupply]. (Put the top card of your deck in Reserve.)'
      ),
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

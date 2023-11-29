<?php
namespace ALT\Cards\MU;

class MU_Common_Kodama extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_09_C',
      'asset' => 'ALT_CORE_B_MU_09_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Kodama'),
      'typeline' => clienttranslate('Character - Plant Spirit'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, SPIRIT],
      'effectDesc' => clienttranslate(
        '{M} I gain [[Asleep]]. (Ignore my statistics during Dusk. At Night, I don\'t go to Reserve and I lose Asleep.)'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

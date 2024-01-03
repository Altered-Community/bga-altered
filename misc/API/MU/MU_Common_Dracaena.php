<?php
namespace ALT\Cards\MU;

class MU_Common_Dracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_15_C',
      'asset' => 'ALT_CORE_B_MU_15_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Dracaena'),
      'typeline' => clienttranslate('Character - Plant Dragon'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' => clienttranslate(
        '{J} I gain [[Anchored]]. (During Rest, I don\'t go to Reserve and I lose Anchored.)  At Noon — I gain 1 boost.'
      ),
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Common_Hydracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_22_C',
      'asset' => 'ALT_CORE_B_MU_22_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hydracaena'),
      'typeline' => clienttranslate('Character - Plant Dragon'),
      'type' => CHARACTER,
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' => clienttranslate(
        '[Eternal].  {J} — I gain 4 boosts.  At Noon — I gain 4 boosts. (At Night, I don\'t join the Reserve.)'
      ),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}

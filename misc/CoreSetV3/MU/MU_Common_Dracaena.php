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
      'name' => 'Dracaena',
      'typeline' => 'Character - Plant Dragon',
      'type' => CHARACTER,
      'flavorText' => "They\'re sometimes seen dozing close to a pond, soaking in the water and the sunlight... ",
      'artist' => 'HuoMiao Studio',
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' => '{J} I gain $[ANCHORED].  At Noon — I gain 1 boost.',
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

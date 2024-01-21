<?php
namespace ALT\Cards\MU;

class MU_Rare_Hydracaena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_22_R1',
      'asset' => 'ALT_CORE_B_MU_22_R1',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => 'Hydracaena',
      'typeline' => 'Character - Plant Dragon',
      'type' => CHARACTER,
      'flavorText' =>
        "When they reach adult size, it\'s clear that the Dracaenas have really thrived on all that rest and relaxation.",
      'artist' => 'Ba Vo',
      'subtypes' => [PLANT, DRAGON],
      'effectDesc' =>
        '$[ETERNAL].  #$[TOUGH_X], where X is the number of plants you control.#  {J} I gain 4 boosts.  At Noon — I gain 4 boosts.',
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 0,
      'costHand' => 7,
      'costReserve' => 7,
    ];
  }
}

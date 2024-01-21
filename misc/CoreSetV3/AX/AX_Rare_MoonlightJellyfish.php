<?php
namespace ALT\Cards\AX;

class AX_Rare_MoonlightJellyfish extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_05_R2',
      'asset' => 'ALT_CORE_B_YZ_05_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Moonlight Jellyfish',
      'typeline' => 'Character - Spirit',
      'type' => CHARACTER,
      'flavorText' =>
        'Theoretically, transdifferentiation can go on indefinitely, effectively rendering the jellyfish biologically immortal... and squishy.',
      'artist' => 'MISSING ARTIST',
      'subtypes' => [SPIRIT],
      'effectDesc' =>
        '#When a Robot joins your Expeditions — You may sacrifice me to give it 2 boosts.#  When I\'m sacrificed, if I\'m not [FLEETING] — Put me in Reserve.',
      'forest' => 1,
      'mountain' => 0,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 1,
    ];
  }
}

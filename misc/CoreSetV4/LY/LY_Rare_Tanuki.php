<?php
namespace ALT\Cards\LY;

class LY_Rare_Tanuki extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_09_R1',
      'asset' => 'ALT_CORE_B_LY_09_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Tanuki'),
      'typeline' => clienttranslate('Character - Spirit'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('"Pom! Pompoko, pom!"'),
      'artist' => 'Matteo Spirito',
      'subtypes' => [SPIRIT],
      'effectDesc' => clienttranslate('{H} $<SABOTAGE>.  #{R} Roll a die. On a 4+, <SABOTAGE_LOW>.#'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

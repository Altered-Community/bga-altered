<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_HelpfulPelican extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_MU_67_C',
      'asset'  => 'ALT_CYCLONE_B_MU_67_C',

      'faction'  => FACTION_MU,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Helpful Pelican"),
      'typeline' => clienttranslate("Character - Animal"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('It\'s not unusual to see these pelicans ferrying small local creatures from one island to the next.'),
      'artist' => "Zael",
      'extension' => 'SO',
      'subtypes'  => [ANIMAL],
      'forest' => 2,
      'mountain' => 1,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 1,
    ];
  }
}

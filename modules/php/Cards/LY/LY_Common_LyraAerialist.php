<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_LyraAerialist extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_72_C',
      'asset'  => 'ALT_CYCLONE_B_LY_72_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Lyra Aerialist"),
      'typeline' => clienttranslate("Character - Artist"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The Cloth Dancers\' great talent is to use every rough spot to adapt to their environment.'),
      'artist' => "Jefrey Yonathan",
      'extension' => 'SO',
      'subtypes'  => [ARTIST],
      'forest' => 0,
      'mountain' => 5,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

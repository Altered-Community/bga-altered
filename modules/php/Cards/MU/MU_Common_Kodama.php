<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

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
      'typeline' => clienttranslate('Character - Spirit Plant'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('There\'s no greater blessing for a tree than to offer a home for a Kodama.'),
      'artist' => 'Ba Vo',
      'subtypes' => [SPIRIT, PLANT],
      'effectDesc' => clienttranslate('{H} I gain $<ASLEEP>.'),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::GAIN(ME, ASLEEP),
    ];
  }
}

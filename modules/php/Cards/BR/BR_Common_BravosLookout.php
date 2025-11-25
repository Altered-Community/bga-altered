<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosLookout extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_93_C',
      'asset'  => 'ALT_DUSTER_B_BR_93_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Bravos Lookout"),
      'typeline' => clienttranslate("Character - Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('"I think I\'ve found a good spot!"'),
      'artist' => "Christophe Young",
      'extension' => 'SDU',
      'subtypes'  => [ADVENTURER],
      'effectDesc' => clienttranslate('{R} I gain 1 boost.'),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 2,
      'costReserve' => 3,
      'effectReserve' => FT::GAIN(ME, BOOST)
    ];
  }
}

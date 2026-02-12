<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_FlyingSquirrel extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_DUSTER_B_BR_86_C',
      'asset'  => 'ALT_DUSTER_B_BR_86_C',

      'faction'  => FACTION_BR,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Flying Squirrel"),
      'typeline' => clienttranslate("Character - Animal Adventurer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('The second big jump is where the fun really starts.'),
      'artist' => "Matteo Spirito",
      'extension' => 'SDU',
      'subtypes'  => [ANIMAL, ADVENTURER],
      'effectDesc' => clienttranslate('{R} I gain 1 boost.'),
      'forest' => 1,
      'mountain' => 1,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 2,
      'effectReserve' => FT::GAIN(ME, BOOST)
    ];
  }
}

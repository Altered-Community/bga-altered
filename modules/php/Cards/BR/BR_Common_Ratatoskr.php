<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Ratatoskr extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_04_C',
      'asset' => 'ALT_CORE_B_BR_04_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ratatoskr'),
      'type' => CHARACTER,
      'subtypes' => [MESSENGER],
      'effectDesc' => clienttranslate('{R} I gain 2 boosts$[BB].'),
      'typeline' => clienttranslate('Character - Messenger'),
      'flavorText' => clienttranslate('You’re nuts if you think you can keep up with this little one!'),
      'artist' => 'Gaga Zhou',

      'forest' => 1,
      'mountain' => 1,
      'ocean' => 1,
      'costHand' => 1,
      'costReserve' => 3,
      'effectReserve' => FT::GAIN($this, BOOST, 2),
    ];
  }
}

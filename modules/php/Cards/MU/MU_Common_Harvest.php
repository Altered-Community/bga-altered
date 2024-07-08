<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_C',
      'asset' => 'ALT_CORE_B_MU_29_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Harvest'),
      'typeline' => clienttranslate('Spell - Conjuration'),
      'type' => SPELL,
      'flavorText' => clienttranslate('The thankful receiver bears a plentiful harvest.'),
      'artist' => 'Ba Vo',
      'subtypes' => [CONJURATION],
      'effectDesc' => clienttranslate('$<RESUPPLY>.'),
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(RESUPPLY, []),
    ];
  }
}

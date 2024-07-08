<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Harvest extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_29_R2',
      'asset' => 'ALT_CORE_B_MU_29_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
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

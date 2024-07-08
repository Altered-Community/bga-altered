<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_Hooked extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_20_R2',
      'asset' => 'ALT_CORE_B_AX_20_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Hooked'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'flavorText' => clienttranslate('Get over here!'),
      'artist' => 'HuoMiao Studio',
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        'Target Character switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'
      ),
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),
    ];
  }
}

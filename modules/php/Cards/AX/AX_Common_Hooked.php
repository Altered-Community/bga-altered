<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Hooked extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_20_C',
      'asset' => 'ALT_CORE_B_AX_20_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Hooked',
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        'Target Character switches Expeditions. (It leaves its Expedition and joins its controller\'s other Expedition.)'
      ),
      'costHand' => 1,
      'costReserve' => 2,
      'effectPlayed' => FT::ACTION(TARGET, ['targetType' => [CHARACTER, TOKEN], 'effect' => FT::ACTION(MOVE_CARD, [])]),
      'flavorText' => 'Get over here!',
      'typeline' => 'Spell - Maneuver',
      'artist' => 'HuoMiao Studio',
    ];
  }
}

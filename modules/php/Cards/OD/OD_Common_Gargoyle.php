<?php

namespace ALT\Cards\OD;

use ALT\Helpers\FT;

class OD_Common_Gargoyle extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_OR_71_C',
      'asset'  => 'ALT_CYCLONE_B_OR_71_C',

      'faction'  => FACTION_OD,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Gargoyle"),
      'typeline' => clienttranslate("Character - Elemental"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('At the slightest sign of intrusion, these stone lookouts come to life and sound the alarm.'),
      'artist' => "Taras Susak",
      'extension' => 'SO',
      'subtypes'  => [ELEMENTAL],
      'effectDesc' => clienttranslate('{H} Target Expedition <ASCENDS>. (Until Rest, it can move forward even if matched in its region\'s terrains by the opponent\'s Expedition.)'),
      'forest' => 2,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET_EXPEDITION, ['effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'ascend'])]),
    ];
  }
}

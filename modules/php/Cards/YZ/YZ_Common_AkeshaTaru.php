<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_AkeshaTaru extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_01_C',
      'asset' => 'ALT_CORE_B_YZ_01_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Akesha & Taru'),
      'type' => HERO,
      'typeline' => clienttranslate('Yzmir Hero'),
      'flavorText' => clienttranslate('Whatever ordeals we may face, good manners and politeness are always in fashion!'),
      'artist' => 'Taras Susak',

      'reserveSlots' => 2,
      'landmarkSlots' => 2,

      'effectDesc' => clienttranslate('{T} : $<AFTER_YOU>. You can only activate this if you are the first player.'),
      'effectTap' => FT::ACTION(CHECK_CONDITION, ['condition' => 'isFirstPlayer', 'effect' => FT::ACTION(AFTER_YOU, [])]),
    ];
  }
}

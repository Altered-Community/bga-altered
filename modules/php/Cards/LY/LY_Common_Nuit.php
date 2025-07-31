<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_Nuit extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_LY_73_C',
      'asset'  => 'ALT_CYCLONE_B_LY_73_C',

      'faction'  => FACTION_LY,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Nuit"),
      'typeline' => clienttranslate("Character - Deity"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate('Gone is the sun, and again comes the night.'),
      'artist' => "Exia",
      'extension' => 'SO',
      'subtypes'  => [DEITY],
      'effectDesc' => clienttranslate('{H} If there are nine or more base statistics of 0 among Characters you control and in your Reserve, each player passes. (Starting with you, they end their Afternoon and don\'t take any more turns this Day.)'),
      'forest' => 0,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 2,
      'blockAutomaticAction' => [CHECK_CONDITION => ['hasXWithZeroStat:all:9']],
      'effectHand' => FT::ACTION(CHECK_CONDITION, ['condition' => 'hasXWithZeroStat:all:9', 'effect' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'allPass'])])
    ];
  }
}

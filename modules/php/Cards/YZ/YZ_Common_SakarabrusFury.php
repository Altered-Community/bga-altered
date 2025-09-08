<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_SakarabrusFury extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CYCLONE_B_YZ_80_C',
      'asset'  => 'ALT_CYCLONE_B_YZ_80_C',

      'faction'  => FACTION_YZ,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Sakarabru's Fury"),
      'typeline' => clienttranslate("Spell - Maneuver"),
      'type'  => SPELL,
      'flavorText'  => clienttranslate('With a single gesture, Sakarabru swept away days of progress.'),
      'artist' => "DOBA",
      'extension' => 'SO',
      'subtypes'  => [MANEUVER],
      'effectDesc' => clienttranslate('$<FLEETING>.  Target Expedition moves backwards one region.'),
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::SEQ(
        FT::GAIN(ME, FLEETING),
        FT::ACTION(MOVE_EXPEDITION, ['n' => -1]),
      )
    ];
  }
}

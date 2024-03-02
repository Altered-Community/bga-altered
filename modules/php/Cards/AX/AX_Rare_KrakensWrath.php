<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_KrakensWrath extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_26_R2',
      'asset' => 'ALT_CORE_B_YZ_26_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => "Kraken's Wrath",
      'typeline' => 'Spell - Disruption',
      'type' => SPELL,
      'flavorText' =>
      'The roaring waves crashed down over the charging armies, and countless soldiers vanished beneath the raging waters.',
      'artist' => 'Matteo Spirito',
      'subtypes' => [DISRUPTION],
      'effectDesc' => '$<FLEETING>.  Send to Reserve up to #four# target Characters with a total Hand Cost #{6} or less#.',
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['upTo' => true, 'n' => 4, 'totalCost' => 6, 'effect' => FT::DISCARD_TO_RESERVE()])
      ),
    ];
  }
}

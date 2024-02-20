<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Common_KrakensWrath extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_26_C',
      'asset' => 'ALT_CORE_B_YZ_26_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate("Kraken's Wrath"),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Send to Reserve up to three target Characters with a total Hand Cost {5} or less.'
      ),
      'typeline' => clienttranslate('Spell - Disruption'),
      'flavorText' => clienttranslate(
        'The roaring waves crashed down over the charging armies, and countless soldiers vanished beneath the raging waters.'
      ),
      'artist' => 'Matteo Spirito',

      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::SEQ(
        FT::GAIN($this, FLEETING),
        FT::ACTION(TARGET, ['upTo' => true, 'n' => 3, 'totalCost' => 5, 'effect' => FT::DISCARD_TO_RESERVE()])
      ),
    ];
  }
}

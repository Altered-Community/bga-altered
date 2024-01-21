<?php
namespace ALT\Cards\YZ;

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
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'flavorText' => clienttranslate(
        'The roaring waves crashed down over the charging armies, and countless soldiers vanished beneath the raging waters.'
      ),
      'artist' => 'MISSING ARTIST',
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Send to Reserve up to three target Characters with a total Hand Cost {5} or less.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

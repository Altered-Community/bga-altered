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
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Send to Reserve up to three target Characters with total Hand Cost {5} or less.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

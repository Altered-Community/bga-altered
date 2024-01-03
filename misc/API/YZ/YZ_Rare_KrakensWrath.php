<?php
namespace ALT\Cards\YZ;

class YZ_Rare_KrakensWrath extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_26_R1',
      'asset' => 'ALT_CORE_B_YZ_26_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate("Kraken's Wrath"),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Send to Reserve up to four target Characters with a total Hand Cost {6} or less.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

<?php
namespace ALT\Cards\LY;

class LY_Rare_PaintPrison extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_26_R1',
      'asset' => 'ALT_CORE_B_LY_26_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Paint Prison'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  You may discard a card from your Reserve to reduce my cost by {1}.  Return target Character or Permanent to the top of it\'s owner\'s deck. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Rare_PaintPrison extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_26_R2',
      'asset' => 'ALT_CORE_B_LY_26_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Paint Prison'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  You may discard a card from your Reserve to reduce my cost by {2}.  Return target Character or Permanent to the top of it\'s owner\'s deck. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

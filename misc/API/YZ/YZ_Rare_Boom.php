<?php
namespace ALT\Cards\YZ;

class YZ_Rare_Boom extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_21_R2',
      'asset' => 'ALT_CORE_B_AX_21_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Boom!'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'flavorText' => clienttranslate('Catastrophic failure ? I prefer the term \'learning opportunity\'.'),
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Sacrifice a Character. If you do, discard target Character or Permanent.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

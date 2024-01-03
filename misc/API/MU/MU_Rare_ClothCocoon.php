<?php
namespace ALT\Cards\MU;

class MU_Rare_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_R2',
      'asset' => 'ALT_CORE_B_LY_24_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Cloth Cocoon'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Choose one:  • Discard target [[Fleeting]], [[Anchored]] or [[Asleep]] Character.  • Discard target Permanent.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

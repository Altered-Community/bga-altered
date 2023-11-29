<?php
namespace ALT\Cards\LY;

class LY_Rare_ClothCocoon extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_24_R1',
      'asset' => 'ALT_CORE_B_LY_24_R1',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Cloth Cocoon'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Discard target [[Fleeting]], [[Anchored]] or [[Asleep]] Character. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

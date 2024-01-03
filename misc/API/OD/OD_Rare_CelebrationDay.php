<?php
namespace ALT\Cards\OD;

class OD_Rare_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_R1',
      'asset' => 'ALT_CORE_B_OR_27_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Celebration Day'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Expeditions can\'t move forward this Day.'
      ),
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}

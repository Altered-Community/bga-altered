<?php
namespace ALT\Cards\YZ;

class YZ_Rare_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_R2',
      'asset' => 'ALT_CORE_B_OR_27_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Celebration Day'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Expeditions can\'t move forward this Day. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 8,
      'costReserve' => 8,
    ];
  }
}

<?php
namespace ALT\Cards\OD;

class OD_Common_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_C',
      'asset' => 'ALT_CORE_B_OR_27_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Celebration Day'),
      'typeline' => clienttranslate('Spell - Maneuver'),
      'type' => SPELL,
      'subtypes' => [MANEUVER],
      'effectDesc' => clienttranslate(
        '[[Fleeting]]. (Send me to Discard instead of Reserve after my effect resolves.)  Target Expedition can\'t move forward this Day.'
      ),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

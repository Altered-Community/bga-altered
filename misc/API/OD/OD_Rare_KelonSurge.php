<?php
namespace ALT\Cards\OD;

class OD_Rare_KelonSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_23_R2',
      'asset' => 'ALT_CORE_B_AX_23_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelon Surge'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  • Send to Reserve target Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

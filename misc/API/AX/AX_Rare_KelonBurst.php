<?php
namespace ALT\Cards\AX;

class AX_Rare_KelonBurst extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_23_R1',
      'asset' => 'ALT_CORE_B_AX_23_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Kelon Burst'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'flavorText' => clienttranslate(
        'There\'s an enduring legend in the Suspira quarries: the existence of another type of Kelon.'
      ),
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  • Send to Reserve target Character with Hand Cost {4} or less.  • Discard target Permanent with Hand Cost {4} or less.  If you control two or more Landmarks, create a [Brassbug 2/2/2] Robot token in target Expedition.'
      ),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

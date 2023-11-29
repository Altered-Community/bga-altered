<?php
namespace ALT\Cards\AX;

class AX_Rare_StickyNoteSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_25_R2',
      'asset' => 'ALT_CORE_B_OR_25_R2',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Sticky Note Seals'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  • Send to Reserve target Character with Hand Cost {4} or more.  • Discard target Permanent with Hand Cost {4} or more. (Send me to Discard instead of Reserve after my effect resolves.)'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

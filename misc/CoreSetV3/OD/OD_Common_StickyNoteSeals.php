<?php
namespace ALT\Cards\OD;

class OD_Common_StickyNoteSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_25_C',
      'asset' => 'ALT_CORE_B_OR_25_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sticky Note Seals'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'flavorText' => clienttranslate('Some lessons stick better than others.'),
      'artist' => 'Atanas Lozanski',
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate(
        '$<FLEETING>.  Choose one:  • Send to Reserve target Character with Hand Cost {4} or more.  • Discard target Permanent with Hand Cost {4} or more.'
      ),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

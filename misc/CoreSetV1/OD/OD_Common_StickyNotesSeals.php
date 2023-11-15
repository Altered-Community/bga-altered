<?php
namespace ALT\Cards\OD;

class OD_Common_StickyNotesSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_25_C',
      'asset' => 'ALT_CORE_B_OR_25_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Sticky Notes Seals'),
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate(
        '$[FLEETING].  Choose one:  - Send to Reserve target Character of hand cost {4} or more.  - Discard target Permanent of hand cost {4} or more.  '
      ),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

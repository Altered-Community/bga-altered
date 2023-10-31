<?php
namespace ALT\Cards\OD;

class OD_Common_StickyNotesSeals extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '150',
      'asset' => 'OD-33-Strength-in-Numbers-01',
      'frameSize' => 1,

      'faction' => FACTION_OD,
      'name' => clienttranslate('Sticky Notes Seals'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  - Send to Reserve target Character of hand cost {4} or more.   - Discard target Permanent of hand cost {4} or more.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

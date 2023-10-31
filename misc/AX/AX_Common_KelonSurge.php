<?php
namespace ALT\Cards\AX;

class AX_Common_KelonSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '15',
      'asset' => 'AX-23-Parallax-Dialer-C',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Kelon Surge'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  - Send to Reserve target Character of hand cost {4} or less.   - Banish target Permanent of hand cost {4} or less.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

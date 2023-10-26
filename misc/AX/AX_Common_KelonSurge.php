<?php
namespace ALT\Cards\AX;

class AX_Common_KelonSurge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '15',
      'asset' => 'AX-26_Parallax_Dialer_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_AX,
      'name' => clienttranslate('Kelon Surge'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate(
        '[[Fleeting]].  Choose one:  - Send to Reserve target Character of hand cost {4} or less.   - Banish target Permanent of hand cost {4} or less.'
      ),
      'reminders' => clienttranslate('(Fleeting: After my effect resolves, banish me.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

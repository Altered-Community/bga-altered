<?php
namespace ALT\Cards\OD;

class OD_Common_Charge extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '147',
      'asset' => 'ALT_CORE_B_OD_23_C_FRAMELESS_T1',
      'frameSize' => 1,

      'faction' => FACTION_OR,
      'name' => clienttranslate('Charge!'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('[[Fleeting]].  Your Characters gain 1 boost.'),
      'reminders' => clienttranslate(
        '(Fleeting: After my effect resolves, banish me. Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'
      ),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

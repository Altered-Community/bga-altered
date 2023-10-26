<?php
namespace ALT\Cards\LY;

class LY_Common_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    $this->properties = [
      'uid' => '91',
      'asset' => 'LY-47_Loaded_Die_RGB_01',
      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('All In!'),
      'type' => SPELL,
      'subtype' => '',
      'typeline' => 'Common - ',
      'rarity' => RARITY_COMMON,

      'effectDesc' => clienttranslate('Roll a die. Target Character gains X boosts, where X is the die\'s result.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

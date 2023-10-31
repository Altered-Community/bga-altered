<?php
namespace ALT\Cards\LY;

class LY_Common_AllIn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);

    $this->properties = [
      'uid' => '91',
      'asset' => 'LY-25-Loaded-Die-C',

      'frameSize' => 1,

      'faction' => FACTION_LY,
      'name' => clienttranslate('All In!'),
      'typeline' => clienttranslate('Common'),
      'rarity' => RARITY_COMMON,
      'type' => SPELL,
      'subtype' => '',

      'effectDesc' => clienttranslate('Roll a die. Target Character gains X boosts, where X is the die\'s result.'),
      'reminders' => clienttranslate('(Boosts are +1/+1/+1 counters that are removed when they leave the Expedition Zone.)'),
      'costHand' => 3,
      'costMemory' => 3,
    ];
  }
}

<?php
namespace ALT\Cards\OD;

class OD_Common_CelebrationDay extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_27_C',
      'asset' => 'ALT_CORE_B_OR_27_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Celebration Day'),
      'type' => SPELL,
      'subtype' => SUPPORT,
      'effectDesc' => clienttranslate('$[FLEETING].  Target Expedition cannot advance this Day.  '),
      'costHand' => 5,
      'costMemory' => 5,
    ];
  }
}

<?php
namespace ALT\Cards\MU;

class MU_Common_BeautySleep extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_28_C',
      'asset' => 'ALT_CORE_B_MU_28_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Beauty Sleep'),
      'type' => SPELL,
      'subtype' => DISRUPTION,
      'effectDesc' => clienttranslate('Target Character becomes $[ASLEEP].  '),
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

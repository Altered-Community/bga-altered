<?php
namespace ALT\Cards\AX;

class AX_Common_Hooked extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_20_C',
      'asset' => 'ALT_CORE_B_AX_20_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hooked'),
      'type' => SPELL,
      'subtype' => MANEUVER,
      'effectDesc' => clienttranslate('Target Character joins the other Expedition of its controller.  '),
      'costHand' => 1,
      'costMemory' => 1,
    ];
  }
}

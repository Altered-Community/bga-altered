<?php
namespace ALT\Cards\AX;

class AX_Common_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_28_C',
      'asset' => 'ALT_CORE_B_AX_28_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Armored Jammer'),
      'type' => PERMANENT,
      'subtype' => LANDMARK,
      'effectDesc' => clienttranslate('{J} $[SABOTAGE].  '),
      'costHand' => 2,
      'costMemory' => 2,
    ];
  }
}

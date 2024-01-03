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
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate('In a jam? Sorry, mate. Maybe a side-effect of our scrambling...'),
      'effectDesc' => clienttranslate('{J} $[SABOTAGE].'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

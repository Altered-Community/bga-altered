<?php
namespace ALT\Cards\OD;

class OD_Rare_ArmoredJammer extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_28_R2',
      'asset' => 'ALT_CORE_B_AX_28_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Armored Jammer'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'flavorText' => clienttranslate('In a jam? Sorry, mate. Maybe a side-effect of our scrambling...'),
      'effectDesc' => clienttranslate('{J} $[SABOTAGE].  #When I leave your Landmark zone — [SABOTAGE].#'),
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

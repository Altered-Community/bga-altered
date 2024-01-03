<?php
namespace ALT\Cards\YZ;

class YZ_Rare_GrandEndeavor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_29_R2',
      'asset' => 'ALT_CORE_B_OR_29_R2',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Grand Endeavor'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Target Expedition moves forward.'),
      'costHand' => 6,
      'costReserve' => 6,
    ];
  }
}

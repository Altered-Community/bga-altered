<?php
namespace ALT\Cards\OD;

class OD_Rare_BanishingGate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_24_R2',
      'asset' => 'ALT_CORE_B_YZ_24_R2',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Banishing Gate'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('$[FLEETING].  Discard target Character or Permanent.'),
      'costHand' => 4,
      'costReserve' => 4,
    ];
  }
}

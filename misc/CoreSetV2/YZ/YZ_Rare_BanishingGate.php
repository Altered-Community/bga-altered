<?php
namespace ALT\Cards\YZ;

class YZ_Rare_BanishingGate extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_24_R1',
      'asset' => 'ALT_CORE_B_YZ_24_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Banishing Gate'),
      'typeline' => clienttranslate('Spell - Disruption'),
      'type' => SPELL,
      'subtypes' => [DISRUPTION],
      'effectDesc' => clienttranslate('Discard target Character or Permanent.'),
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['costReserve'],
    ];
  }
}

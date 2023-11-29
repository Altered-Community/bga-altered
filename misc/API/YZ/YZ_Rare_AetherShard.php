<?php
namespace ALT\Cards\YZ;

class YZ_Rare_AetherShard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_29_R1',
      'asset' => 'ALT_CORE_B_YZ_29_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Aether Shard'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('{J} Draw a card.  At Noon — Draw a card.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

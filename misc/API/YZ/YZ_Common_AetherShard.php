<?php
namespace ALT\Cards\YZ;

class YZ_Common_AetherShard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_29_C',
      'asset' => 'ALT_CORE_B_YZ_29_C',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Aether Shard'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('At Noon — Draw a card.'),
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

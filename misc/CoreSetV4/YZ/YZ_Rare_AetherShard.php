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
      'name' => 'Aether Shard',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'No mere trinket, but a fragment of purest dream.',
      'artist' => 'Anh Tung',
      'subtypes' => [LANDMARK],
      'effectDesc' => '#{J} Draw a card.#  At Noon — Draw a card.',
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

<?php
namespace ALT\Cards\YZ;

class YZ_Rare_BabasIsba extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_28_R1',
      'asset' => 'ALT_CORE_B_YZ_28_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => "Baba's Isba",
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => "Boney Legs, she's called, and her hut is one reason why.",
      'artist' => 'Taras Susak',
      'subtypes' => [LANDMARK],
      'effectDesc' => '{J} Draw a card.  {T}, Sacrifice a Character: $[AFTER_YOU].',
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}

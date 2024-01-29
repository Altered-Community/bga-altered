<?php
namespace ALT\Cards\OD;

class OD_Rare_TheMonolithOrdisBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_28_R1',
      'asset' => 'ALT_CORE_B_OR_28_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'The Monolith, Ordis Bastion',
      'typeline' => 'Permanent - Landmark',
      'type' => PERMANENT,
      'flavorText' => 'A beacon of knowledge and order, a lighthouse towering high above the world.',
      'artist' => 'Jean-Baptiste Andrier',
      'subtypes' => [LANDMARK],
      'effectDesc' => 'When a #non-token# Character joins your Expeditions — It gains 1 boost$<BB>.',
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['costHand', 'costReserve'],
    ];
  }
}

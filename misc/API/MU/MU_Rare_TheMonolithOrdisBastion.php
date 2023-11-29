<?php
namespace ALT\Cards\MU;

class MU_Rare_TheMonolithOrdisBastion extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_28_R2',
      'asset' => 'ALT_CORE_B_OR_28_R2',

      'faction' => FACTION_MU,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('The Monolith, Ordis Bastion'),
      'typeline' => clienttranslate('Permanent - Landmark'),
      'type' => PERMANENT,
      'subtypes' => [LANDMARK],
      'effectDesc' => clienttranslate('When a non-token Character joins your Expeditions — It gains 1 boost.'),
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

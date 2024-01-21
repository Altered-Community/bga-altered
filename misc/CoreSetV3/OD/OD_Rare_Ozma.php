<?php
namespace ALT\Cards\OD;

class OD_Rare_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_R1',
      'asset' => 'ALT_CORE_B_OR_11_R1',

      'faction' => FACTION_OD,
      'rarity' => RARITY_RARE,
      'name' => 'Ozma',
      'typeline' => 'Character - Noble',
      'type' => CHARACTER,
      'flavorText' => "\"Never give up. No one knows what’s going to happen next.\"",
      'artist' => 'Taras Susak',
      'subtypes' => [NOBLE],
      'effectDesc' => '{J} If you control three or more other Characters, draw a card. (Cards in Reserve are not controlled.)',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],
    ];
  }
}

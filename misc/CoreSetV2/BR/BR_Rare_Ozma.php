<?php
namespace ALT\Cards\BR;

class BR_Rare_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_R2',
      'asset' => 'ALT_CORE_B_OR_11_R2',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Ozma'),
      'typeline' => clienttranslate('Character - Noble'),
      'type' => CHARACTER,
      'subtypes' => [NOBLE],
      'effectDesc' => clienttranslate('{J} If you control #two or more other [BOOSTED]# Characters, draw a card.'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'ocean'],
    ];
  }
}

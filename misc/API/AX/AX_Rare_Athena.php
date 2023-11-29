<?php
namespace ALT\Cards\AX;

class AX_Rare_Athena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_18_R1',
      'asset' => 'ALT_CORE_B_AX_18_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Athena'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate(
        '{M} If you control two or more Landmarks, I gain 2 boosts.  {S} If you control two or more Landmarks, I lose [[Fleeting]].'
      ),
      'forest' => 3,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

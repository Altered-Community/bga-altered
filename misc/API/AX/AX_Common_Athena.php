<?php
namespace ALT\Cards\AX;

class AX_Common_Athena extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_18_C',
      'asset' => 'ALT_CORE_B_AX_18_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Athena'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{S} If you control two or more Landmarks, I lose [[Fleeting]].'),
      'forest' => 3,
      'mountain' => 4,
      'ocean' => 4,
      'costHand' => 5,
      'costReserve' => 5,
    ];
  }
}

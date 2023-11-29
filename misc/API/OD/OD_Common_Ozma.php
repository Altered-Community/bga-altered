<?php
namespace ALT\Cards\OD;

class OD_Common_Ozma extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_11_C',
      'asset' => 'ALT_CORE_B_OR_11_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ozma'),
      'typeline' => clienttranslate('Character - Noble'),
      'type' => CHARACTER,
      'subtypes' => [NOBLE],
      'effectDesc' => clienttranslate(
        '{J} If you control three or more other Characters, draw a card. (Cards in Reserve are not controlled.)'
      ),
      'forest' => 1,
      'mountain' => 2,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,
    ];
  }
}

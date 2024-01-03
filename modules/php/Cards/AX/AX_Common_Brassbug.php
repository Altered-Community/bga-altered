<?php

namespace ALT\Cards\AX;

class AX_Common_Brassbug extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_31_C',
      'asset' => 'ALT_CORE_B_AX_31_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Brassbug'),
      'type' => TOKEN,
      'subtypes' => [ROBOT],
      'effectDesc' => clienttranslate('(If I leave the Expedition zone, remove me from the game.)'),
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'token' => true,
      'flavorText' => clienttranslate(
        '01010001 01110101 01100101 01100101 01101110 00100000 01101001 01101110 00100000 01000010 00101101 01001000 01101001 01110110 01100101'
      ),
      'typeline' => clienttranslate('Token - Robot'),
    ];
  }
}

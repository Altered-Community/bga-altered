<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Parvati extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_18_C',
      'asset' => 'ALT_CORE_B_MU_18_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Parvati'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate(
        '{H} Target Character gains <ANCHORED>. (During Rest, it doesn\'t go to Reserve and it loses Anchored.)'
      ),
      'flavorText' => clienttranslate('Only in harmony can the world thrive.'),
      'artist' => 'Nestor Papatriantafyllou',

      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET, ['effect' => FT::GAIN($this, ANCHORED)]),
    ];
  }
}

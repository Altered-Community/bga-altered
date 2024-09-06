<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Ganesha extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_19_C',
      'asset' => 'ALT_CORE_B_AX_19_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ganesha'),
      'type' => CHARACTER,
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate('{J} For each Permanent you control, you may activate its {j} abilities.'),
      'flavorText' => clienttranslate('Knowledge and wisdom must walk side by side.'),
      'typeline' => clienttranslate('Character - Deity'),
      'artist' => 'Taras Susak',

      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 7,
      'costReserve' => 7,

      'effectPlayed' => FT::ACTION(SPECIAL_EFFECT, ['effect' => 'activateAllPermanents']),
    ];
  }
}

<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_Aja extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_17_C',
      'asset' => 'ALT_CORE_B_MU_17_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Aja'),
      'typeline' => clienttranslate('Character - Deity'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate(
        'She is the soul of the forest, the patron of herbal medicine. From herbs and roots, she mixes potent potions.'
      ),
      'artist' => 'Rémi Jacquot',
      'subtypes' => [DEITY],
      'effectDesc' => clienttranslate(
        '{H} Each player puts the top card of their deck in their Mana zone (as an exhausted Mana Orb).'
      ),
      'forest' => 4,
      'mountain' => 5,
      'ocean' => 4,
      'costHand' => 4,
      'costReserve' => 4,
      'effectHand' => FT::ACTION(DRAW, ['location' => MANA, 'tapped' => true]),
    ];
  }
}

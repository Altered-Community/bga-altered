<?php

namespace ALT\Cards\LY;

class LY_Common_LyraChronicler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_16_C',
      'asset' => 'ALT_CORE_B_LY_16_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Lyra Chronicler'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'typeline' => clienttranslate('Character - Artist'),
      'flavorText' => clienttranslate(
        'Eidolon or human, we are all shaped by stories. They\'re the building blocks of our identity. '
      ),
      'artist' => 'Taras Susak',

      'forest' => 4,
      'mountain' => 0,
      'ocean' => 4,
      'costHand' => 3,
      'costReserve' => 3,
    ];
  }
}

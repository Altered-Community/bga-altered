<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_Hathor extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_07_C',
      'asset' => 'ALT_CORE_B_LY_07_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Hathor'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST, DEITY],
      'supportDesc' => clienttranslate(
        '{D} : Return another card from your Reserve to your hand. (Discard me from Reserve to do this.)'
      ),
      'supportIcon' => 'discard',
      'typeline' => clienttranslate('Character - Artist Deity'),
      'flavorText' => clienttranslate('Dance is the language of the soul.'),
      'artist' => 'Taras Susak',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
      'effectSupport' => FT::ACTION(TARGET, [
        'targetPlayer' => ME,
        'targetLocation' => [RESERVE],
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'effect' => FT::RETURN_TO_HAND(),
      ]),
    ];
  }
}

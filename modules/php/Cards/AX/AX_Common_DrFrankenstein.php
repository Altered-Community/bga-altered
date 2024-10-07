<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_DrFrankenstein extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_17_C',
      'asset' => 'ALT_CORE_B_AX_17_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Dr. Frankenstein'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{R} You may activate the {j} abilities of target Permanent you control.'),
      'flavorText' => clienttranslate('We sometimes seek companionship in the strangest of life forms.'),
      'typeline' => clienttranslate('Character - Engineer'),
      'artist' => 'Taras Susak',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 3,

      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [PERMANENT],
        'targetPlayer' => ME,
        'upTo' => true,
        'hasEffects' => ['Played'],
        'effect' => FT::ACTION(ACTIVATE_EFFECT, []),
      ]),
    ];
  }
}

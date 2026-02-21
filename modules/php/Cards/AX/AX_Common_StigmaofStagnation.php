<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_StigmaofStagnation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_116_C',
      'asset'  => 'ALT_EOLE_B_AX_116_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Stigma of Stagnation"),
      'typeline' => clienttranslate("Character - Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
      'extension' => 'ROC',
      'subtypes'  => [CORRUPTION],
      'effectDesc' => clienttranslate('{R} Discard your hand.'),
      'forest' => 3,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 4,
      'costReserve' => 3,
      'effectReserve' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'n' => INFTY,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}

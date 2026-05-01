<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_StigmaofStagnation extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_116_R1',
      'asset'  => 'ALT_EOLE_B_AX_116_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Stigma of Stagnation"),
      'typeline' => clienttranslate("Character - Corruption"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Anh Tung",
      'extension' => 'ROC',
      'subtypes'  => [CORRUPTION],
      'effectDesc' => clienttranslate('#{J}# Discard your hand.'),
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 3,
      'costReserve' => 3,
      'changedStats' => ['forest', 'costHand'],
      'effectPlayed' => FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [HAND],
        'n' => INFTY,
        'effect' => FT::ACTION(DISCARD, []),
      ]),
    ];
  }
}

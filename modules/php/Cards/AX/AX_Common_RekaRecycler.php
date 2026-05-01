<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_RekaRecycler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_114_C',
      'asset'  => 'ALT_EOLE_B_AX_114_C',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_COMMON,
      'name'  => clienttranslate("Reka Recycler"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} You may discard two cards from your Reserve to draw a card.'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'effectHand' => FT::SEQ_OPTIONAL(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetPlayer' => ME,
          'targetLocation' => [RESERVE],
          'n' => 2,
          'effect' => FT::SEQ(
            FT::ACTION(DISCARD, []),
            FT::ACTION(DRAW, ['players' => ME])
          ),
        ]),
      ),
    ];
  }
}

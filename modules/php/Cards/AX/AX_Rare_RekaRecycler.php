<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_RekaRecycler extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_EOLE_B_AX_114_R1',
      'asset'  => 'ALT_EOLE_B_AX_114_R',

      'faction'  => FACTION_AX,
      'rarity'  => RARITY_RARE,
      'name'  => clienttranslate("Reka Recycler"),
      'typeline' => clienttranslate("Character - Engineer"),
      'type'  => CHARACTER,
      'flavorText'  => clienttranslate(''),
      'artist' => "Tristan Bideau",
      'extension' => 'ROC',
      'subtypes'  => [ENGINEER],
      'effectDesc' => clienttranslate('{H} You may discard #one card# from your Reserve to draw a card.'),
      'forest' => 3,
      'mountain' => 1,
      'ocean' => 3,
      'costHand' => 3,
      'costReserve' => 2,
      'changedStats' => ['mountain'],
      'effectHand' =>  FT::ACTION(TARGET, [
        'targetType' => [CHARACTER, SPELL, PERMANENT],
        'targetPlayer' => ME,
        'targetLocation' => [RESERVE],
        'effect' => FT::SEQ(
          FT::ACTION(DISCARD, []),
          FT::ACTION(DRAW, ['players' => ME])
        ),
      ]),
    ];
  }
}

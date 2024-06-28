<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_AmahleAsgarthanOutcast extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_19_R2',
      'asset' => 'ALT_CORE_B_LY_19_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Amahle, Asgarthan Outcast',
      'typeline' => 'Character - Scholar',
      'type' => CHARACTER,
      'flavorText' => 'The old world is dying, and the new world struggles to be born: now is the time of monsters.',
      'artist' => 'Khoa Viet',
      'subtypes' => [SCHOLAR],
      'effectDesc' => '{J} You may discard a card from your Reserve to draw a card.',
      'forest' => 5,
      'mountain' => 5,
      'ocean' => 5,
      'costHand' => 5,
      'costReserve' => 5,
      'effectPlayed' => FT::ACTION(
        TARGET,
        [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetPlayer' => ME,
          'targetLocation' => [RESERVE],
          'upTo' => true,
          'effect' => FT::SEQ(FT::ACTION(DISCARD, []), FT::ACTION(DRAW, ['players' => ME])),
        ],
        ['optional' => true]
      ),
    ];
  }
}

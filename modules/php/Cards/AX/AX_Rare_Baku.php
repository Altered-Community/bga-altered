<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_Baku extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_YZ_10_R2',
      'asset' => 'ALT_CORE_B_YZ_10_R',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Baku',
      'typeline' => 'Character - Spirit',
      'type' => CHARACTER,
      'flavorText' => '"I’ve seen it myself! \'Baku! Baku!\', it says, eating up ghosts as though they were candies."',
      'artist' => 'Zero Wen',
      'subtypes' => [SPIRIT],
      'effectDesc' => '{H} Target opponent discards a card from their hand.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 2,
      'effectHand' => FT::ACTION(TARGET_PLAYER, ['effect' =>  FT::ACTION(
        TARGET,
        [
          'targetPlayer' => ME,
          'targetLocation' => [HAND],
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'effect' => FT::ACTION(DISCARD, []),
        ]
      )])
    ];
  }
}

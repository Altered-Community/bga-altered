<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Rare_OuroborosInkcaster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_10_R2',
      'asset' => 'ALT_CORE_B_LY_10_R1',

      'faction' => FACTION_AX,
      'rarity' => RARITY_RARE,
      'name' => 'Ouroboros Inkcaster',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => 'When luck joins in the game, cleverness scores double. ',
      'artist' => 'Khoa Viet',
      'subtypes' => [ARTIST],
      'effectDesc' =>
      'When I go to Reserve from the Expedition zone — You may return another card from your Reserve to your hand.',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'changedStats' => ['forest', 'mountain', 'costHand', 'costReserve'],
      'effectPassive' => [
        'LeaveExpedition' => [
          'output' => FT::ACTION(
            TARGET,
            [
              'targetLocation' => [RESERVE],
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN, SPELL],
              'excludeSelf' => true,
              'effect' => FT::RETURN_TO_HAND(),
            ],
            ['optional' => true]
          ),
        ],
      ],
    ];
  }
}

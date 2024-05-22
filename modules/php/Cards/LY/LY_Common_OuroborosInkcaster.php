<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Common_OuroborosInkcaster extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_10_C',
      'asset' => 'ALT_CORE_B_LY_10_C',

      'faction' => FACTION_LY,
      'rarity' => RARITY_COMMON,
      'name' => 'Ouroboros Inkcaster',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' =>
      'When I go to Reserve from the Expedition zone — You may return another card from your Reserve to your hand.',
      'flavorText' => 'When luck joins in the game, cleverness scores double. ',
      'artist' => 'Khoa Viet',

      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,

      'effectPassive' => [
        'LeaveExpedition' => [
          'condition' => 'notFleeting',
          'output' =>  FT::ACTION(
            TARGET,
            [
              'targetLocation' => [RESERVE],
              'targetPlayer' => ME,
              'targetType' => [CHARACTER, TOKEN, SPELL],
              'excludeSelf' => true,
              'effect' => FT::RETURN_TO_HAND(),
            ],
            ['optional' => true]
          )
        ],
      ],
    ];
  }
}

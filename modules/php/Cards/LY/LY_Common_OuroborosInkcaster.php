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
      'name' => clienttranslate('Ouroboros Inkcaster'),
      'typeline' => clienttranslate('Character - Artist'),
      'type' => CHARACTER,
      'subtypes' => [ARTIST],
      'effectDesc' => clienttranslate(
        'When I go to Reserve from the Expedition zone — You may return another card from your Reserve to your hand.'
      ),
      'forest' => 3,
      'mountain' => 3,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,

      'effectPassive' => [
        'LeaveExpedition' => [
          'output' => FT::ACTION(
            TARGET,
            ['targetLocation' => [RESERVE], 'targetPlayer' => ME, 'targetType' => [CHARACTER, TOKEN, SPELL], 'effect' => FT::RETURN_TO_HAND()],
            ['optional' => true]
          )
        ],
      ],
    ];
  }
}

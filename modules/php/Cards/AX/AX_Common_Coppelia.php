<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_Coppelia extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_14_C',
      'asset' => 'ALT_CORE_B_AX_14_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => 'Coppélia',
      'type' => CHARACTER,
      'subtypes' => [ROBOT],
      'effectDesc' => 'When I go to Reserve from your hand — You may play me for free and I gain $[ASLEEP].',
      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,

      'effectPassive' => [
        'Discard' => [
          'condition' => 'isDiscardedFromHandToReserve',
          'output' => FT::SEQ(
            FT::ACTION(PLAY_CARD, ['cardId' => ME, 'free' => true], ['optional' => true]),
            FT::GAIN($this, ASLEEP)
          ),
        ],
      ],
      'flavorText' => "Because of her artificial nature, she served as a model for the Faction\'s first Automata prototypes.",
      'typeline' => 'Character - Robot',
      'artist' => 'Taras Susak',
    ];
  }
}

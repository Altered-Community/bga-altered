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
      'name' => clienttranslate('Coppélia'),
      'type' => CHARACTER,
      'subtypes' => [ROBOT],
      'effectDesc' => clienttranslate('When I go to Reserve from your hand — You may play me for free and I gain $<ASLEEP>.'),
      'flavorText' => clienttranslate(
        'Because of her artificial nature, she served as a model for the Faction\'s first Automata prototypes.'
      ),
      'typeline' => clienttranslate('Character - Robot'),
      'artist' => 'Taras Susak',

      'forest' => 2,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 2,

      'effectPassive' => [
        'Discard' => [
          // 'listeningConditions' => ['isMyselfDiscarded:hand:reserve'],
          'condition' => 'isMyselfDiscarded:hand:reserve',
          // 'forceListening' => true,
          'output' => FT::SEQ_OPTIONAL(FT::ACTION(PLAY_CARD, ['cardId' => ME, 'free' => true]), FT::GAIN(ME, ASLEEP)),
        ],
      ],
    ];
  }
}

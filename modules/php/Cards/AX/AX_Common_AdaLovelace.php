<?php

namespace ALT\Cards\AX;

use ALT\Helpers\FT;

class AX_Common_AdaLovelace extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_13_C',
      'asset' => 'ALT_CORE_B_AX_13_C',

      'faction' => FACTION_AX,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Ada Lovelace'),
      'type' => CHARACTER,
      'subtypes' => [ENGINEER],
      'effectDesc' => clienttranslate('{R} You may put a card from your hand in Reserve. If it\'s a Permanent, draw a card.'),
      'forest' => 1,
      'mountain' => 3,
      'ocean' => 1,
      'costHand' => 2,
      'costReserve' => 2,

      'effectReserve' => FT::ACTION(
        TARGET,
        [
          'targetType' => [CHARACTER, SPELL, PERMANENT],
          'targetPlayer' => ME,
          'targetLocation' => [HAND],
          'effect' => FT::DISCARD_TO_RESERVE(),
        ],
        ['optional' => true]
      ),

      // using passive effect to listen to check what was discarded
      'effectPassive' => [
        'Discard' => ['condition' => 'isSourceAndDiscardPermanent', 'output' => FT::ACTION(DRAW, ['players' => ME])],
      ],
      'flavorText' => clienttranslate(
        'Imagination is the discovering faculty. It is that which penetrates the unseen worlds around us.'
      ),
      'typeline' => clienttranslate('Character - Engineer'),
    ];
  }
}

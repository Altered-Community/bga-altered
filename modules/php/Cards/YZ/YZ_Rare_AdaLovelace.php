<?php

namespace ALT\Cards\YZ;

use ALT\Helpers\FT;

class YZ_Rare_AdaLovelace extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_AX_13_R2',
      'asset' => 'ALT_CORE_B_AX_13_R1',

      'faction' => FACTION_YZ,
      'rarity' => RARITY_RARE,
      'name' => 'Ada Lovelace',
      'typeline' => 'Character - Engineer',
      'type' => CHARACTER,
      'flavorText' => '"Imagination is the discovering faculty. It is that which penetrates the unseen worlds around us."',
      'artist' => 'Taras Susak',
      'subtypes' => [ENGINEER],
      'effectDesc' => '{R} You may put a card from your hand in Reserve. If it\'s a #Spell#, draw a card.',
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
        'Discard' => ['condition' => 'isSourceAndDiscardSpell', 'output' => FT::ACTION(DRAW, ['players' => ME])],
      ],
    ];
  }
}

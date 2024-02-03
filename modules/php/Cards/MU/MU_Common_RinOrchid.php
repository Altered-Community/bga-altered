<?php

namespace ALT\Cards\MU;

use ALT\Helpers\FT;

class MU_Common_RinOrchid extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_MU_03_C',
      'asset' => 'ALT_CORE_B_MU_03_C',

      'faction' => FACTION_MU,
      'rarity' => RARITY_COMMON,
      'name' => 'Rin & Orchid',
      'typeline' => 'Muna Hero',
      'type' => HERO,
      'flavorText' => 'The forest always gives back, when you know where to look.',
      'artist' => 'Zero Wen',
      'effectDesc' =>
      'When one of your Expeditions moves forward due to {V} — Draw a card, then put a card from your hand in Reserve.',

      'effectPassive' => [
        'AfterDusk' => [
          'condition' => 'movesStormsWithForest',
          'output' => FT::SEQ(
            FT::ACTION(DRAW, ['players' => ME]),
            FT::ACTION(
              TARGET,
              [
                'targetType' => [CHARACTER, SPELL, PERMANENT],
                'targetPlayer' => ME,
                'targetLocation' => [HAND],
                'effect' => FT::DISCARD_TO_RESERVE(),
              ]
            ),
          )
        ]
      ]
    ];
  }
}

<?php

namespace ALT\Cards\LY;

use ALT\Helpers\FT;

class LY_Rare_LyraSkald extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_LY_08_R',
      'asset' => 'ALT_CORE_B_LY_08_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => 'Lyra Skald',
      'typeline' => 'Character - Artist',
      'type' => CHARACTER,
      'flavorText' => 'We\'re all stories, in the end.',
      'artist' => 'Ba Vo',
      'subtypes' => [ARTIST],
      'effectDesc' => '#{H} You may discard a card from your Reserve to $<RESUPPLY_INF>.#',
      'supportDesc' => '#{D} : The next card you play this turn costs {1} less.# (Discard me from Reserve to do this.)',
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 2,
      'costHand' => 2,
      'costReserve' => 2,
      'supportIcon' => 'discard',
      'effectHand' =>  FT::SEQ_OPTIONAL(
        FT::ACTION(TARGET, [
          'targetType' => [CHARACTER, TOKEN, PERMANENT, SPELL],
          'targetPlayer' => ME,
          'targetLocation' => [RESERVE],
          'effect' => FT::ACTION(DISCARD, [])
        ]),
        FT::ACTION(RESUPPLY, [])
      ),
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
      ],
    ];
  }
}

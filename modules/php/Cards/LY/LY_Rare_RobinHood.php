<?php

namespace ALT\Cards\LY;

class LY_Rare_RobinHood extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_21_R2',
      'asset' => 'ALT_CORE_B_OR_21_R',

      'faction' => FACTION_LY,
      'rarity' => RARITY_RARE,
      'name' => clienttranslate('Robin Hood'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Justice comes from a fair redistribution of wealth.'),
      'artist' => 'Taras Susak',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('Characters your opponents play can\'t cost less than {2}. (If they would cost {1} or less, they cost {2} instead.)'),
      'supportDesc' => clienttranslate(
        '#{D} : The next card you play this turn costs {1} less.# (Discard me from Reserve to do this.)'
      ),
      'forest' => 3,
      'mountain' => 0,
      'ocean' => 3,
      'costHand' => 4,
      'costReserve' => 4,
      'changedStats' => ['mountain', 'ocean'],
      // 'increaseOpponentCharacterCost' => 1,
      'opponentCharactersMinimumCost' => 2,
      'supportIcon' => 'discard',
      'effectSupport' => [
        'action' => SPECIAL_EFFECT,
        'args' => ['effect' => 'costReduction', 'args' => ['type' => ALL, 'reduction' => 1]],
      ],
    ];
  }
}

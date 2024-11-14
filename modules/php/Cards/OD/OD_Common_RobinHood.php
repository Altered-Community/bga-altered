<?php

namespace ALT\Cards\OD;

class OD_Common_RobinHood extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_OR_21_C',
      'asset' => 'ALT_CORE_B_OR_21_C',

      'faction' => FACTION_OD,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Robin Hood'),
      'typeline' => clienttranslate('Character - Bureaucrat'),
      'type' => CHARACTER,
      'flavorText' => clienttranslate('Justice comes from a fair redistribution of wealth.'),
      'artist' => 'Taras Susak',
      'subtypes' => [BUREAUCRAT],
      'effectDesc' => clienttranslate('Characters your opponents play can\'t cost less than {2}. (If they would cost {1} or less, they cost {2} instead.)'),
      'forest' => 3,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 4,
      'costReserve' => 4,
      // 'increaseOpponentCharacterCost' => 1,
      'opponentCharactersMinimumCost' => 2
    ];
  }
}

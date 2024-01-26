<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_BravosVanguard extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_14_C',
      'asset' => 'ALT_CORE_B_BR_14_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Bravos Vanguard',
      'type' => CHARACTER,
      'subtypes' => [ADVENTURER],
      'effectDesc' => '{J} You may have another target Character lose [FLEETING_CHAR].',
      'typeline' => 'Character - Adventurer',
      'artist' => 'Edward Cheekokseang',
      'flavorText' =>
        "\"We will be the arrow that pierces the veil of the unknown, the torch that banishes the mists of ignorance!\"",

      'forest' => 4,
      'mountain' => 2,
      'ocean' => 2,
      'costHand' => 3,
      'costReserve' => 3,

      'effectPlayed' => FT::ACTION(TARGET, ['statuses' => FLEETING, 'upTo' => true, 'effect' => FT::LOOSE(EFFECT, FLEETING)]),
    ];
  }
}

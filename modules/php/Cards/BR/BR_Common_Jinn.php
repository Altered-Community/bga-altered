<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_Jinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_19_C',
      'asset' => 'ALT_CORE_B_BR_19_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Jinn'),
      'type' => CHARACTER,
      'subtype' => [ELEMENTAL],
      'effectDesc' => clienttranslate('When I leave the Expedition zone — You may put me in my owner\'s Mana Orbs exhausted.'),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 3,

      'effectPassive' => [
        // necessary to put both as cleanup doesn't trigger custom turn order
        'LeaveExpedition' => [
          'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true], ['optional' => true])
        ],
        'BeforeNight' => [
          'condition' => 'myTurn',
          'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true], ['optional' => true])
        ]
      ]
    ];
  }
}

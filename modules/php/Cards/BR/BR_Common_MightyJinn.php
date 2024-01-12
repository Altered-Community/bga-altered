<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_MightyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_19_C',
      'asset' => 'ALT_CORE_B_BR_19_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => clienttranslate('Mighty Jinn'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone — You may put me in my owner\'s Mana zone (as an exhausted Mana Orb).'
      ),
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 3,

      'effectPassive' => [
        'LeaveExpedition' => [
          'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true], ['optional' => true]),
        ],
      ],
      'typeline' => clienttranslate('Character - Elemental'),
    ];
  }
}

<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Rare_MightyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_19_R1',
      'asset' => 'ALT_CORE_B_BR_19_R1',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Mighty Jinn',
      'typeline' => 'Character - Elemental',
      'type' => CHARACTER,
      'flavorText' => 'A single spark can start a wildfire.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [ELEMENTAL],
      'effectDesc' =>
      'When I leave the Expedition zone — You may put me in my owner\'s Mana zone (as an exhausted Mana Orb). #If you don\'t, draw a card.#',
      'forest' => 4,
      'mountain' => 4,
      'ocean' => 0,
      'costHand' => 4,
      'costReserve' => 3,
      'effectPassive' => [
        'LeaveExpedition' => [
          'output' => FT::XOR(
            FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'force' => true, 'tapped' => true]),
            FT::ACTION(DRAW, ['players' => ME])
          )
        ],
      ],
    ];
  }
}

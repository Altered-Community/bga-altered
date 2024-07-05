<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;


class BR_Rare_TinyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_06_R',
      'asset' => 'ALT_CORE_B_BR_06_R',

      'faction' => FACTION_BR,
      'rarity' => RARITY_RARE,
      'name' => 'Tiny Jinn',
      'typeline' => 'Character - Elemental',
      'type' => CHARACTER,
      'flavorText' => 'It may be a fire today — tomorrow it will be ashes.',
      'artist' => 'HuoMiao Studio',
      'subtypes' => [ELEMENTAL],
      'effectDesc' =>
      'When I leave the Expedition zone, if I\'m <BOOSTED> — Put me in my owner\'s Mana zone (as an exhausted Mana Orb).  {R} I gain 1 boost.',
      'forest' => 0,
      'mountain' => 2,
      'ocean' => 0,
      'costHand' => 1,
      'costReserve' => 2,
      'changedStats' => ['mountain', 'costHand', 'costReserve'],
      'effectReserve' => FT::GAIN($this, BOOST),
      'effectPassive' => [
        'LeaveExpedition' => [
          'condition' => 'hasBoost',
          'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true]),
        ],
      ],
    ];
  }
}

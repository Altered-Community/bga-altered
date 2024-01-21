<?php

namespace ALT\Cards\BR;

use ALT\Helpers\FT;

class BR_Common_TinyJinn extends \ALT\Models\Card
{
  public function __construct($row)
  {
    parent::__construct($row);
    $this->properties = [
      'uid' => 'ALT_CORE_B_BR_06_C',
      'asset' => 'ALT_CORE_B_BR_06_C',

      'faction' => FACTION_BR,
      'rarity' => RARITY_COMMON,
      'name' => 'Tiny Jinn',
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'When I leave the Expedition zone, if I\'m [BOOSTED] — Put me in my owner\'s Mana zone (as an exhausted Mana Orb).  {R} I gain 1 boost.'
      ),
      'forest' => 0,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
      'effectReserve' => FT::GAIN($this, BOOST),
      'effectPassive' => [
        'LeaveExpedition' => [
          'condition' => 'isBoosted',
          'output' => FT::ACTION(DISCARD, ['cardId' => ME, 'destination' => MANA, 'tapped' => true]),
        ],
      ],
      'typeline' => 'Character - Elemental',
      'flavorText' => 'It may be a fire today — tomorrow it will be ashes.',
      'artist' => 'HuoMiao Studio',
    ];
  }
}

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
      'name' => clienttranslate('Tiny Jinn'),
      'type' => CHARACTER,
      'subtypes' => [ELEMENTAL],
      'effectDesc' => clienttranslate(
        'If I would leave the Expedition zone while I\'m <BOOSTED>, put me in my owner\'s Mana zone instead (as an exhausted Mana Orb).  {R} I gain 1 boost.'
      ),
      'typeline' => clienttranslate('Character - Elemental'),
      'flavorText' => clienttranslate('It may be a fire today — tomorrow it will be ashes.'),
      'artist' => 'HuoMiao Studio',

      'forest' => 0,
      'mountain' => 3,
      'ocean' => 0,
      'costHand' => 2,
      'costReserve' => 3,
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
